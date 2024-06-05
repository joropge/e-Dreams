<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Carrito;
use App\Models\Producto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Direccion;
use Illuminate\Support\Facades\Auth;

class CarritoControllerTest extends TestCase
{
    use RefreshDatabase;

    // public function testIndex()
    // {
    //     // Crear un usuario y autenticarlo
    //     $user = User::factory()->create();
    //     $this->actingAs($user);

    //     // Crear productos y carritos
    //     $producto = Producto::factory()->create(['precio' => 100]);
    //     Carrito::factory()->create([
    //         'user_id' => $user->id,
    //         'producto_id' => $producto->id,
    //         'cantidad' => 2,
    //     ]);

    //     // Llamar al método index
    //     $response = $this->get(route('carrito.index'));

    //     // Verificar que la vista se carga correctamente
    //     $response->assertStatus(200);
    //     $response->assertViewIs('users.carrito.index');
    //     $response->assertViewHas('carritos');
    //     $response->assertViewHas('total', 200); // 2 * 100 = 200
    // }

    /** @test */
    public function it_redirects_to_login_if_user_is_not_authenticated()
    {
        // Simular que no hay un usuario autenticado
        Auth::shouldReceive('user')->andReturn(null);

        // Hacer una petición GET al método index
        $response = $this->get(route('carrito.index'));

        // Verificar que se redirige a la página de login
        $response->assertRedirect(route('login'));
        $response->assertSessionHas('error', 'Por favor, inicie sesión para acceder a su carrito.');
    }

    /** @test */
    public function it_displays_the_carrito_page_for_authenticated_user()
    {
        // Crear un usuario
        $user = User::factory()->create();

        // Simular que el usuario está autenticado
        Auth::shouldReceive('user')->andReturn($user);

        // Crear algunos productos y carritos
        $producto = Producto::factory()->create(['precio' => 100]);
        Carrito::factory()->create([
            'user_id' => $user->id,
            'producto_id' => $producto->id,
            'cantidad' => 2,
        ]);

        // Hacer una petición GET al método index
        $response = $this->actingAs($user)->get(route('carrito.index'));

        // Verificar que la vista se carga correctamente
        $response->assertStatus(200);
        $response->assertViewIs('users.carrito.index');
        $response->assertViewHas('carritos');
        $response->assertViewHas('total', 200);
    }

    public function testUpdate()
    {
        // Crear un usuario y autenticarlo
        $user = User::factory()->create();
        $this->actingAs($user);

        // Crear producto y carrito
        $producto = Producto::factory()->create(['precio' => 100]);
        $carrito = Carrito::factory()->create([
            'user_id' => $user->id,
            'producto_id' => $producto->id,
            'cantidad' => 1,
        ]);

        // Llamar al método update
        $response = $this->put(route('carrito.update', $carrito->id), [
            'cantidad' => 3,
        ]);

        // Verificar la respuesta
        $response->assertJson(['success' => true]);

        // Verificar que la cantidad y el total se actualizan en la base de datos
        $carrito->refresh();
        $this->assertEquals(3, $carrito->cantidad);
        $this->assertEquals(300, $carrito->total); // 3 * 100 = 300
    }

    public function testDelete()
    {
        // Crear un usuario y autenticarlo
        $user = User::factory()->create();
        $this->actingAs($user);

        // Crear producto y carrito
        $carrito = Carrito::factory()->create([
            'user_id' => $user->id,
        ]);

        // Llamar al método delete
        $response = $this->delete(route('carrito.delete', ['id' => $carrito->id]));

        // Verificar la respuesta
        $response->assertStatus(302); // Redirecciona back

        // Verificar que el carrito se elimina de la base de datos
        $this->assertDatabaseMissing('carritos', ['id' => $carrito->id]);
    }

    public function testDestroy()
    {
        // Crear un usuario y autenticarlo
        $user = User::factory()->create();
        $this->actingAs($user);

        // Crear producto y carritos
        Carrito::factory()->create(['user_id' => $user->id]);

        // Llamar al método destroy
        $response = $this->delete(route('carrito.destroy'));

        // Verificar la respuesta
        $response->assertStatus(302); // Redirecciona back

        // Verificar que todos los carritos del usuario se eliminan de la base de datos
        $this->assertDatabaseMissing('carritos', ['user_id' => $user->id]);
    }

    public function testSuccess()
    {
        // Crear un usuario y autenticarlo
        $user = User::factory()->create();
        $this->actingAs($user);

        // Crear dirección, producto y carrito
        $direccion = Direccion::factory()->create(['user_id' => $user->id]);
        $producto = Producto::factory()->create();
        $carrito = Carrito::factory()->create([
            'user_id' => $user->id,
            'producto_id' => $producto->id,
            'cantidad' => 1,
        ]);

        // Llamar al método success
        $response = $this->get(route('carrito.success', ['session_id' => 'fake_session_id']));

        // Verificar la respuesta
        $response->assertStatus(200);
        $response->assertViewIs('users.carrito.success');
    }

    public function testCancel()
    {
        // Llamar al método cancel
        $response = $this->get(route('carrito.cancel'));

        // Verificar la respuesta
        $response->assertStatus(200);
        $response->assertViewIs('users.carrito.cancel');
    }

    public function testAdd()
    {
        // Crear un usuario y autenticarlo
        $user = User::factory()->create();
        $this->actingAs($user);

        // Crear producto
        $producto = Producto::factory()->create(['precio' => 100]);

        // Llamar al método add
        $response = $this->post(route('carrito.add'), [
            'id' => $producto->id,
            'cantidad' => 2,
        ]);

        // Verificar la respuesta
        $response->assertStatus(302); // Redirecciona back

        // Verificar que el producto se añade al carrito
        $this->assertDatabaseHas('carritos', [
            'user_id' => $user->id,
            'producto_id' => $producto->id,
            'cantidad' => 2,
            'total' => 200,
        ]);
    }
}
