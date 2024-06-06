<?php

// namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;
// use Tests\TestCase;
// use App\Models\Producto;
// use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;
// use Tests\TestCase;
// use App\Models\Producto;
// use RefreshDatabase;

// class ProductoControllerTest extends TestCase
// {

    namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\Producto;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


    class ProductoControllerTest extends TestCase
    {

        /**
         * Test the index method of ProductoController.
         *
         * @return void
         */

        use RefreshDatabase;
        // public function testIndex()
        // {
        //     $this->refreshDatabase();
        //     // Create some dummy products
        //     Producto::factory()->count(3)->create();

        //     // Send a GET request to the index route
        //     $response = $this->get(route('dashboard'));

        //     // Assert that the response has a successful status code
        //     $response->assertStatus(200);

        //     // Assert that the response view has the correct view name
        //     $response->assertViewIs('productos.index');

        //     // Assert that the response view has the correct data
        //     $response->assertViewHas('productos');
        // }

        /**
         * Test the camisetasIndex method of ProductoController.
         *
         * @return void
         */
        public function testCamisetasIndex()
        {
            $this->refreshDatabase();

            Categoria::factory()->create(['id' => 1, 'nombre' => 'Camisetas']);
            // Create some dummy products with categoria_id = 1
            Producto::factory()->count(3)->create(['categoria_id' => 1]);

            // Send a GET request to the camisetasIndex route
            $response = $this->get(route('camisetas.index'));

            // Assert that the response has a successful status code
            $response->assertStatus(200);

            // Assert that the response view has the correct view name
            $response->assertViewIs('productos.camisetas.index');

            // Assert that the response view has the correct data
            $response->assertViewHas('productos');
        }

        /**
         * Test the sudaderasIndex method of ProductoController.
         *
         * @return void
         */
        public function testSudaderasIndex()
        {
            $this->refreshDatabase();

            Categoria::factory()->create(['id' => 2, 'nombre' => 'Sudaderas']);
            // Create some dummy products with categoria_id = 2
            Producto::factory()->count(3)->create(['categoria_id' => 2]);

            // Send a GET request to the sudaderasIndex route
            $response = $this->get(route('sudaderas.index'));

            // Assert that the response has a successful status code
            $response->assertStatus(200);

            // Assert that the response view has the correct view name
            $response->assertViewIs('productos.sudaderas.index');

            // Assert that the response view has the correct data
            $response->assertViewHas('productos');
        }

        /**
         * Test the pantalonesIndex method of ProductoController.
         *
         * @return void
         */
        public function testPantalonesIndex()
        {
            $this->refreshDatabase();

            Categoria::factory()->create(['id' => 3, 'nombre' => 'Pantalones']);
            // Create some dummy products with categoria_id = 3
            Producto::factory()->count(3)->create(['categoria_id' => 3]);

            // Send a GET request to the pantalonesIndex route
            $response = $this->get(route('pantalones.index'));

            // Assert that the response has a successful status code
            $response->assertStatus(200);

            // Assert that the response view has the correct view name
            $response->assertViewIs('productos.pantalones.index');

            // Assert that the response view has the correct data
            $response->assertViewHas('productos');
        }

        /**
         * Test the frontIndex method of ProductoController.
         *
         * @return void
         */
    }
// }
