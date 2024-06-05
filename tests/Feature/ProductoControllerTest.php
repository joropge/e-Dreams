<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Producto;

class ProductoControllerTest extends TestCase
{
    
    public function testIndex()
{
    // Crear algunos productos
    Producto::factory()->count(5)->create();

    // Llamar al método index
    $response = $this->get(route('productos.index'));

    // Verificar que la vista se carga correctamente
    $response->assertStatus(200);
    $response->assertViewIs('productos.index');
    $response->assertViewHas('productos', Producto::all());
}

public function testShow()
{
    // Crear un producto
    $producto = Producto::factory()->create();

    // Llamar al método show
    $response = $this->get(route('productos.show', $producto->id));

    // Verificar que la vista se carga correctamente
    $response->assertStatus(200);
    $response->assertViewIs('productos.show');
    $response->assertViewHas('producto', $producto);
}

public function testCamisetasIndex()
{
    // Crear productos con categoría_id = 1
    Producto::factory()->count(3)->create(['categoria_id' => 1]);
    Producto::factory()->count(2)->create(['categoria_id' => 2]); // Otros productos para verificar filtrado

    // Llamar al método camisetasIndex
    $response = $this->get(route('productos.camisetas.index'));

    // Verificar que la vista se carga correctamente
    $response->assertStatus(200);
    $response->assertViewIs('productos.camisetas.index');
    $response->assertViewHas('productos', Producto::where('categoria_id', 1)->get());
}

public function testSudaderasIndex()
{
    // Crear productos con categoría_id = 2
    Producto::factory()->count(3)->create(['categoria_id' => 2]);
    Producto::factory()->count(2)->create(['categoria_id' => 1]); // Otros productos para verificar filtrado

    // Llamar al método sudaderasIndex
    $response = $this->get(route('productos.sudaderas.index'));

    // Verificar que la vista se carga correctamente
    $response->assertStatus(200);
    $response->assertViewIs('productos.sudaderas.index');
    $response->assertViewHas('productos', Producto::where('categoria_id', 2)->get());
}

public function testPantalonesIndex()
{
    // Crear productos con categoría_id = 3
    Producto::factory()->count(3)->create(['categoria_id' => 3]);
    Producto::factory()->count(2)->create(['categoria_id' => 1]); // Otros productos para verificar filtrado

    // Llamar al método pantalonesIndex
    $response = $this->get(route('productos.pantalones.index'));

    // Verificar que la vista se carga correctamente
    $response->assertStatus(200);
    $response->assertViewIs('productos.pantalones.index');
    $response->assertViewHas('productos', Producto::where('categoria_id', 3)->get());
}

// public function testFrontIndex()
// {
//     // Crear productos con categoría_id = 4
//     Producto::factory()->count(3)->create(['categoria_id' => 4]);
//     Producto::factory()->count(2)->create(['categoria_id' => 1]); // Otros productos para verificar filtrado

//     // Llamar al método frontIndex
//     $response = $this->get(route('productos.zapatos.index'));

//     // Verificar que la vista se carga correctamente
//     $response->assertStatus(200);
//     $response->assertViewIs('productos.zapatos.index');
//     $response->assertViewHas('productos', Producto::where('categoria_id', 4)->get());
// }

    
}
