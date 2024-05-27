<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Carrito;
use App\Models\Producto;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    // public function store(LoginRequest $request): RedirectResponse
    // {
    //     $request->authenticate();

    //     $request->session()->regenerate();

    //     return redirect()->intended(route('dashboard', absolute: false));
    // }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            $cartItems = Carrito::where('user_id', $user->id)->get();
            $carrito = [];

            foreach ($cartItems as $item) {
                $carrito[$item->producto_id] = [
                    'id' => $item->producto_id,
                    'cantidad' => $item->cantidad,
                    // Añade otros detalles del producto según sea necesario
                ];
            }

            session()->put('carrito', $carrito);

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    // public function destroy(Request $request): RedirectResponse
    // {
    //     Auth::guard('web')->logout();

    //     $request->session()->invalidate();

    //     $request->session()->regenerateToken();

    //     return redirect('/');
    // }
    public function destroy(Request $request)
    {
        $user = Auth::user();
    $carrito = session()->get('carrito', []);

    foreach ($carrito as $producto) {
        $productoModel = Producto::find($producto['id']);

        if ($productoModel) {
            $total = $producto['cantidad'] * $productoModel->precio;

            Carrito::updateOrCreate(
                ['user_id' => $user->id, 'producto_id' => $producto['id']],
                ['cantidad' => $producto['cantidad'], 'total' => $total]
            );
        }
    }

    Auth::guard('web')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
        // $user = Auth::user();
        // $carrito = session()->get('carrito', []);

        // foreach ($carrito as $producto) {
        //     Carrito::updateOrCreate(
        //         ['user_id' => $user->id, 'producto_id' => $producto['id']],
        //         ['cantidad' => $producto['cantidad']]
        //     );
        // }

        // Auth::guard('web')->logout();

        // $request->session()->invalidate();
        // $request->session()->regenerateToken();

        // return redirect('/');
    }
}
