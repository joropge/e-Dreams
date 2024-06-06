<?php



namespace Tests\Feature;

use App\Models\Direccion;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;

class DireccionesControllerTest extends TestCase
{
    use InteractsWithDatabase;
    use RefreshDatabase;
    /**
     * Test the index method.
     *
     * @return void
     */
    public function testIndex()
    {
        $user = User::factory()->create();
        $direccion = Direccion::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get(route('direcciones.index'));

        $response->assertStatus(200);
        $response->assertViewIs('.users.direcciones.index');
        $response->assertViewHas('direcciones', Direccion::all());
    }

    /**
     * Test the create method.
     *
     * @return void
     */
    public function testCreate()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('direcciones.create'));

        $response->assertStatus(200);
        $response->assertViewIs('.users.direcciones.create');
        $response->assertViewHas('success', 'Dirección creada correctamente');
    }

    /**
     * Test the store method.
     *
     * @return void
     */
    public function testStore()
    {
        $user = User::factory()->create();

        $data = [
            'calle' => '123 Main St',
            'numero' => '1',
            'codigo_postal' => '12345',
            'ciudad' => 'City',
            'provincia' => 'Province',
            'pais' => 'Country',
        ];

        $response = $this->actingAs($user)->post(route('direcciones.store'), $data);

        $response->assertStatus(200);
        $response->assertViewIs('.users.direcciones.index');
        $response->assertViewHas('direcciones', Direccion::all());
    }

    /**
     * Test the edit method.
     *
     * @return void
     */
    public function testEdit()
    {
        $user = User::factory()->create();
        $direccion = Direccion::factory()->create();

        $response = $this->actingAs($user)->get(route('direcciones.edit', $direccion));

        $response->assertStatus(200);
        $response->assertViewIs('.users.direcciones.edit');
        $response->assertViewHas('direcciones', $direccion);
        $response->assertViewHas('users', User::all());
    }

    /**
     * Test the update method.
     *
     * @return void
     */
    public function testUpdate()
    {
        $user = User::factory()->create();
        $direccion = Direccion::factory()->create(['user_id' => $user->id]);

        $data = [
            'calle' => '456 Main St',
            'numero' => '2',
            'codigo_postal' => '54321',
            'ciudad' => 'City',
            'provincia' => 'Province',
            'pais' => 'Country',
        ];

        $response = $this->actingAs($user)->put(route('direcciones.update', $direccion), $data);

        $response->assertRedirect(route('direcciones.index'));
        $response->assertSessionHas('success', 'Dirección actualizada correctamente');
    }

    /**
     * Test the destroy method.
     *
     * @return void
     */
    public function testDestroy()
    {
        $user = User::factory()->create();
        $direccion = Direccion::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->delete(route('direcciones.destroy', $direccion));

        $response->assertRedirect(route('direcciones.index'));
        $response->assertSessionHas('success', 'Dirección eliminada correctamente');
    }
}
