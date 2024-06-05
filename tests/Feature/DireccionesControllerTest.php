<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Direccion;
use App\Models\User;
use App\Models\Carrito;
use App\Models\Producto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;

class DireccionesControllerTest extends TestCase
{
    public function testIndex()
    {
        // Crear algunas direcciones
        Direccion::factory()->count(3)->create();

        // Llamar al método index
        $response = $this->get(route('direcciones.index'));

        // Verificar que la vista se carga correctamente
        $response->assertStatus(200);
        $response->assertViewIs('/users/direcciones.index');
        $response->assertViewHas('direcciones', Direccion::all());
    }

    public function testCreate()
    {
        // Llamar al método create
        $response = $this->get(route('direcciones.create'));

        // Verificar que la vista se carga correctamente
        $response->assertStatus(200);
        $response->assertViewIs('/users/direcciones.create');

        // Verificar mensaje de sesión
        $response->assertSessionHas('success', 'Dirección creada correctamente');
    }

    public function testStore()
    {
        // Crear un usuario y autenticarlo
        $user = User::factory()->create();
        $this->actingAs($user);

        // Datos de ejemplo para la dirección
        $data = [
            'calle' => 'Calle Ejemplo',
            'numero' => '123',
            'piso' => '4',
            'puerta' => 'B',
            'codigo_postal' => '28001',
            'ciudad' => 'Madrid',
            'provincia' => 'Madrid',
            'pais' => 'España',
        ];

        // Llamar al método store
        $response = $this->post(route('direcciones.store'), $data);

        // Verificar que la dirección se ha creado en la base de datos
        $this->assertDatabaseHas('direcciones', array_merge($data, ['user_id' => $user->id]));

        // Verificar que se redirige a la vista index con las direcciones
        $response->assertStatus(200);
        $response->assertViewIs('/users/direcciones.index');
        $response->assertViewHas('direcciones', Direccion::all());
    }

    public function testEdit()
    {
        // Crear una dirección y algunos usuarios
        $direccion = Direccion::factory()->create();
        User::factory()->count(3)->create();

        // Llamar al método edit
        $response = $this->get(route('direcciones.edit', $direccion->id));

        // Verificar que la vista se carga correctamente
        $response->assertStatus(200);
        $response->assertViewIs('/users/direcciones.edit');
        $response->assertViewHas('direcciones', $direccion);
        $response->assertViewHas('users', User::all());
    }

    public function testUpdate()
    {
        // Crear un usuario y autenticarlo
        $user = User::factory()->create();
        $this->actingAs($user);

        // Crear una dirección
        $direccion = Direccion::factory()->create(['user_id' => $user->id]);

        // Datos de ejemplo para la actualización
        $data = [
            'calle' => 'Calle Actualizada',
            'numero' => '456',
            'piso' => '5',
            'puerta' => 'A',
            'codigo_postal' => '28002',
            'ciudad' => 'Barcelona',
            'provincia' => 'Barcelona',
            'pais' => 'España',
        ];

        // Llamar al método update
        $response = $this->put(route('direcciones.update', $direccion->id), $data);

        // Verificar que la dirección se ha actualizado en la base de datos
        $this->assertDatabaseHas('direcciones', array_merge($data, ['id' => $direccion->id]));

        // Verificar que se redirige a la vista index con mensaje de éxito
        $response->assertRedirect(route('direcciones.index'));
        $response->assertSessionHas('success', 'Dirección actualizada correctamente');
    }

    public function testDestroy()
    {
        // Crear un usuario y autenticarlo
        $user = User::factory()->create();
        $this->actingAs($user);

        // Crear una dirección
        $direccion = Direccion::factory()->create(['user_id' => $user->id]);

        // Llamar al método destroy
        $response = $this->delete(route('direcciones.destroy', $direccion->id));

        // Verificar que la dirección se ha eliminado de la base de datos
        $this->assertDatabaseMissing('direcciones', ['id' => $direccion->id]);

        // Verificar que se redirige a la vista index con mensaje de éxito
        $response->assertRedirect(route('direcciones.index'));
        $response->assertSessionHas('success', 'Dirección eliminada correctamente');
    }
}
