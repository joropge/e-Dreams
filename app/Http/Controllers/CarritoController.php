<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Models\Pedido;
use Stripe\Stripe;
use Illuminate\View\View;
use App\Models\Direccion;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Storage;
use Stripe\Climate\Order as ClimateOrder;

class CarritoController extends Controller
{
    public function index()
    {
        $carritos = \App\Models\Carrito::with('producto')->get();
        $user = Auth::user();
        $carritos = Carrito::where('user_id', $user->id)->with('producto')->get();


        $total = 0;
        foreach ($carritos as $carrito) {
            $total += $carrito->producto->precio * $carrito->cantidad;
        }

        return view('users.carrito.index', compact('carritos', 'total'));
    }

    public function update(Request $request, $id)
    {

        try {
            $carrito = Carrito::findOrFail($id);
            $carrito->cantidad = $request->cantidad;


            if ($carrito->cantidad == 0) {
                $carrito->delete();
            } else {
                $carrito->total = $carrito->cantidad * $carrito->producto->precio;
            }
            $carrito->save();


            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage('Error al incrementar o disminuir la cantidad del producto')], 500);
        }
    }

    public function delete(Request $request)
    {
        $carrito = Carrito::findOrFail($request->id);
        $carrito->delete();
        return back();
    }

    public function destroy()
    {
        $user = Auth::user();
        Carrito::where('user_id', $user->id)->delete();
        return back();

        // return redirect()->route('users.carrito.index');
    }

    public function checkout(Request $request)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SK'));

        $user = Auth::user();
        // Obtener los productos del carrito
        $carritos = Carrito::where('user_id', $user->id)->get();
        // $productoIds = $carritos->pluck('producto_id')->toArray();
        // $productos = Producto::whereIn('id', $productoIds)->get();


        // $carritos = Carrito::all();
        $lineItems = [];
        $totalPrice = 0;
        foreach ($carritos as $carrito) {
            $totalPrice += $carrito->precio;
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $carrito->producto->nombre,

                        // 'images' => [$carrito->imagen]
                    ],
                    'unit_amount' => $carrito->total * 100,
                ],
                'quantity' => $carrito->cantidad,
            ];
        }
        $session = \Stripe\Checkout\Session::create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('carrito.success', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
            'cancel_url' => route('carrito.cancel', [], true),
        ]);

        // $order = new Pedido();
        // $order->estado = 'pendiente';
        // $order->total = $totalPrice;
        // $order->user_id = Auth::id();
        // $order->producto_id = $carrito->producto_id;
        // $order->nombre = $carrito->producto->nombre;
        // $order->direccion_id = $carrito->direccion_id;
        // $order->updated_at = now();
        // $order->created_at = now();
        // $order->save();

        return redirect($session->url);
        // Return Inertia::location($checkout_session->url);
        // return back()->with('success', 'Compra realizada con éxito.');
    }

    public function success(Request $request)
    {
        $user = Auth::user();
        $direccion = Direccion::where('user_id', $user->id)->first();
        $carrito = Carrito::where('user_id', $user->id)->with('producto')->get();
        $productoIds = $carrito->pluck('producto_id')->toArray();

        $productos = Producto::whereIn('id', $productoIds)->get();
        $productoNombres = [];
        foreach ($productos as $producto) {
            $productoNombres[$producto->id] = $producto->nombre;
        }
        // Verificar si el usuario tiene una dirección
        if (!$direccion) {
            return back()->with('error', 'Por favor, añade una dirección antes de realizar la compra.');
        }
        // Verificar si el carrito está vacío
        if ($carrito->isEmpty()) {
            return back()->with('error', 'El carrito está vacío.');
        }
        $totalCarrito = 0;
        foreach ($carrito as $item) {
            $totalCarrito += $item->producto->precio * $item->cantidad;
        }
        // Pasar los elementos del carrito a la tabla de pedidos
        foreach ($carrito as $item) {
            $pedido = new Pedido([
                'user_id' => $user->id,
                'producto_id' => $item->producto_id,
                'nombreProducto' => $productoNombres[$item->producto_id],
                'direccion_id' => $direccion->id,
                'estado' => 'pendiente',
                'total' => $item->producto->precio,
            ]);
            $pedido->save();
        }

        // Después del checkout, vaciar el carrito
        Carrito::where('user_id', $user->id)->delete();
        \Stripe\Stripe::setApiKey(env('STRIPE_SK'));
        $sessionId = $request->get('session_id');

        try {

            $session = \Stripe\Checkout\Session::retrieve($sessionId);
            $customerDetails = $session->customer_details;
            $customer = ($customerDetails->name);
            if (!$session) {
                throw new NotFoundHttpException;
            }
            $order = Pedido::where('user_id', Auth::id())->first();
            // dd($order);
            if (!$order) {
                throw new NotFoundHttpException();
            }
            if ($order->estado === 'pendiente') {
                $order->estado = 'enviado';
                $order->save();
            }

            return view('users.carrito.success', compact('customer'));
        } catch (\Exception $e) {
            throw new NotFoundHttpException();
        }
    }

    public function cancel()
    {
        return view('users.carrito.cancel');
    }

        // public function webhook()
        // {
        //     // This is your Stripe CLI webhook secret for testing your endpoint locally.
        //     $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');

        //     $payload = @file_get_contents('php://input');
        //     $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        //     $event = null;

        //     try {
        //         $event = \Stripe\Webhook::constructEvent(
        //             $payload, $sig_header, $endpoint_secret
        //         );
        //     } catch (\UnexpectedValueException $e) {
        //         // Invalid payload
        //         return response('', 400);
        //     } catch (\Stripe\Exception\SignatureVerificationException $e) {
        //         // Invalid signature
        //         return response('', 400);
        //     }

        //     // Handle the event
        //     switch ($event->type) {
        //         case 'checkout.session.completed':
        //             $session = $event->data->object;

        //             $order = Pedido::where('session_id', $session->id)->first();
        //             if ($order && $order->status === 'unpaid') {
        //                 $order->status = 'paid';
        //                 $order->save();
        //                 // Send email to customer
        //             }

        //         // ... handle other event types
        //         default:
        //             echo 'Received unknown event type ' . $event->type;
        //     }

        //     return response('');
        // }

    public function add(Request $request)
    {


        // $request->validate([

        //     'producto_id' => 'required|exists:id',
        //     'cantidad' => 'required|integer|min:1',

        // ]);
        // dd($request->all());

        // Obtener el usuario autenticado
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('register');
        }
        $producto = Producto::find($request->id);
        // $direccion = Direccion::find($request->id);

        // Verificar si el producto existe
        if (!$producto) {
            return redirect()->back()->with('error', 'Producto no encontrado.');
        }

        // Verificar si el producto ya existe en el carrito del usuario
        $carritoItem = Carrito::where('user_id', $user->id)
            ->where('producto_id', $producto->id)
            ->first();


        // Si el producto ya está en el carrito, actualizar la cantidad y el total
        if ($carritoItem) {
            $carritoItem->cantidad += $request->cantidad;
            $carritoItem->total = $carritoItem->cantidad * $producto->precio;
            $carritoItem->save();
        } else {
            // Si el producto no está en el carrito, crear uno nuevo
            $carritoItem = new Carrito([
                'user_id' => $user->id,
                'producto_id' => $producto->id,
                'cantidad' => $request->cantidad,
                'total' => $request->cantidad * $producto->precio,
                // 'direccion_id' => $direccion->id,
            ]);

            $carritoItem->save();
        }

        return redirect()->back()->with('success', 'Producto añadido al carrito.');
    }
}
