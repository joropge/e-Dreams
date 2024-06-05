<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Producto;
use App\Models\Direccion;
use App\Models\Pedido;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PedidoControllerTest extends TestCase
{

//     public function testIndex()
// {
//     // Crear un usuario y autenticarlo
//     $user = User::factory()->create();
//     $this->actingAs($user);

//     // Crear algunos pedidos para el usuario
//     Pedido::factory()->count(3)->create(['user_id' => $user->id]);

//     // Llamar al método index
//     $response = $this->get(route('pedidos.index'));

//     // Verificar que la vista se carga correctamente
//     $response->assertStatus(200);
//     $response->assertViewIs('users.pedidos.index');
//     $response->assertViewHas('pedidos', Pedido::where('user_id', $user->id)->with('productos')->get());
// }

public function it_redirects_to_login_if_user_is_not_authenticated()
    {
        // Simular que no hay un usuario autenticado
        Auth::shouldReceive('user')->andReturn(null);

        // Hacer una petición GET al método index
        $response = $this->get(route('pedidos.index'));

        // Verificar que se redirige a la página de login
        $response->assertRedirect(route('login'));
    }

    public function it_redirects_to_login_with_error_on_exception()
    {
        // Crear un usuario
        $user = User::factory()->create();

        // Simular que el usuario está autenticado
        Auth::shouldReceive('user')->andReturn($user);

        // Simular una excepción cuando se consulta los pedidos
        Pedido::shouldReceive('where')->andThrow(new \Exception('Database error'));

        // Hacer una petición GET al método index
        $response = $this->actingAs($user)->get(route('pedidos.index'));

        // Verificar que se redirige a la página de login con un mensaje de error
        $response->assertRedirect(route('login'));
        $response->assertSessionHas('error', 'Ha ocurrido un error. Por favor, intente nuevamente.');
    }
    public function it_displays_the_pedidos_page_for_authenticated_user()
    {
        // Crear un usuario
        $user = User::factory()->create();

        // Simular que el usuario está autenticado
        Auth::shouldReceive('user')->andReturn($user);

        // Crear algunos productos y pedidos
        $producto = Producto::factory()->create();
        $pedido = Pedido::factory()->create([
            'user_id' => $user->id,
        ]);
        $pedido->productos()->attach($producto->id);

        // Hacer una petición GET al método index
        $response = $this->actingAs($user)->get(route('pedidos.index'));

        // Verificar que la vista se carga correctamente
        $response->assertStatus(200);
        $response->assertViewIs('users.pedidos.index');
        $response->assertViewHas('pedidos');
    }

public function testCreate()
{
    // Crear un usuario y autenticarlo
    $user = User::factory()->create();
    $this->actingAs($user);

    // Crear un producto y una dirección
    $producto = Producto::factory()->create();
    $direccion = Direccion::factory()->create(['user_id' => $user->id]);

    // Datos de ejemplo para el pedido
    $data = [
        'user_id' => $user->id,
        'producto_id' => $producto->id,
        'direccion_id' => $direccion->id,
        'cantidad' => 2,
        'total' => 100.00,
        'estado' => 'pendiente',
        'nombreProducto' => 'Producto de prueba',
    ];

    // Llamar al método create
    $response = $this->post(route('pedidos.create'), $data);

    // Verificar que el pedido se ha creado en la base de datos
    $this->assertDatabaseHas('pedidos', $data);

    // Verificar que se redirige a la vista index con mensaje de éxito
    $response->assertRedirect(route('pedidos.index'));
    $response->assertSessionHas('success', 'Pedido creado correctamente');
}

public function testShow()
{
    // Crear un usuario y autenticarlo
    $user = User::factory()->create();
    $this->actingAs($user);

    // Crear un producto y un pedido
    $producto = Producto::factory()->create();
    $pedido = Pedido::factory()->create(['user_id' => $user->id, 'producto_id' => $producto->id]);

    // Llamar al método show
    $response = $this->get(route('pedidos.show', $pedido->id));

    // Verificar que la vista se carga correctamente
    $response->assertStatus(200);
    $response->assertViewIs('users.pedidos.show');
    $response->assertViewHas('pedido', Pedido::where('id', $pedido->id)->with('productos')->first());
    $response->assertViewHas('productos', $producto);
}

public function testDestroy()
{
    // Crear un usuario y autenticarlo
    $user = User::factory()->create();
    $this->actingAs($user);

    // Crear un pedido
    $pedido = Pedido::factory()->create(['user_id' => $user->id]);

    // Llamar al método destroy
    $response = $this->delete(route('pedidos.destroy', $pedido->id));

    // Verificar que el pedido se ha eliminado de la base de datos
    $this->assertDatabaseMissing('pedidos', ['id' => $pedido->id]);

    // Verificar que se redirige a la vista index con mensaje de éxito
    $response->assertRedirect(route('pedidos.index'));
    $response->assertSessionHas('success', 'Pedido eliminado correctamente');
}

public function testGetProductIdsByUser()
{
    // Crear un usuario y autenticarlo
    $user = User::factory()->create();
    $this->actingAs($user);

    // Crear algunos productos y pedidos
    $productos = Producto::factory()->count(3)->create();
    foreach ($productos as $producto) {
        Pedido::factory()->create(['user_id' => $user->id, 'producto_id' => $producto->id]);
    }

    // Llamar al método getProductIdsByUser
    $response = $this->get(route('pedidos.getProductIdsByUser', $user->id));

    // Verificar que la vista se carga correctamente
    $response->assertStatus(200);
    $response->assertViewIs('users.pedidos.index');
    $response->assertViewHas('pedidos', Pedido::where('user_id', $user->id)->with('productos')->get());

    $productIds = Pedido::where('user_id', $user->id)->with('productos')->get()->pluck('productos.*.id')->flatten()->unique();
    $response->assertViewHas('productIds', $productIds);
}

public function testGetUserProducts()
{
    // Crear un usuario y autenticarlo
    $user = User::factory()->create();
    $this->actingAs($user);

    // Crear algunos productos y pedidos
    $producto = Producto::factory()->create();
    Pedido::factory()->count(2)->create(['user_id' => $user->id, 'producto_id' => $producto->id]);

    // Llamar al método getUserProducts
    $response = $this->get(route('pedidos.getUserProducts', $user->id));

    // Verificar que se obtienen los productos correctos
    $response->assertStatus(200);
    $userProducts = Pedido::select('user_id', 'producto_id', DB::raw('COUNT(*) as cantidad'))
        ->where('user_id', $user->id)
        ->groupBy('user_id', 'producto_id')
        ->having('cantidad', '>', 1)
        ->get();
    $this->assertEquals($userProducts->toArray(), $response->original->toArray());
}



}
