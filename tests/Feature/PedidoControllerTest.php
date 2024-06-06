<?php


namespace Tests\Feature;

use App\Models\Pedido;
use App\Models\Producto;
use App\Models\User;
use App\Models\Direccion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
    use Tests\TestCase;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;


class PedidoControllerTest extends TestCase
{
    use RefreshDatabase;
    use InteractsWithDatabase;    
    /**
     * Test the index method.
     *
     * @return void
     */
    public function testIndex()
    {
        $user = User::factory()->create();
        Auth::login($user);

        $response = $this->get(route('pedidos.index'));

        $response->assertStatus(200);
        $response->assertViewIs('users.pedidos.index');
        $response->assertViewHas('pedidos');
    }

    /**
     * Test the create method.
     *
     * @return void
     */
    public function testCreate()
    {
        $this->refreshDatabase();
        $user = User::factory()->create();
        Auth::login($user);

        $producto = Producto::factory()->create();
        $direccion = Direccion::factory()->create();

        $data = [
            'user_id' => $user->id,
            'producto_id' => $producto->id,
            'direccion_id' => $direccion->id,
            'total' => 10.99,
            'estado' => 'Pendiente',
            'nombreProducto' => 'Producto de prueba',
        ];

        $response = $this->post(route('pedidos.create'), $data);

        $response->assertRedirect(route('pedidos.index'));
        $this->assertDatabaseHas('pedidos', $data);
    }

    /**
     * Test the show method.
     *
     * @return void
     */
    public function testShow()
    {
        $this->refreshDatabase();
        $user = User::factory()->create();
        Auth::login($user);

        $pedido = Pedido::factory()->create();

        $response = $this->get(route('pedidos.show', $pedido));

        $response->assertStatus(200);
        $response->assertViewIs('users.pedidos.show');
        $response->assertViewHas('pedido');
        $response->assertViewHas('productos');

    }

}