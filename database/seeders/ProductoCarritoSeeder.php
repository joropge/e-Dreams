<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoCarritoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Array de datos de prueba para la tabla pivot producto_carrito
        $data = [
            ['producto_id' => 1, 'carrito_id' => 1],
            ['producto_id' => 2, 'carrito_id' => 1],
            ['producto_id' => 3, 'carrito_id' => 2],
            // Agrega más datos aquí según sea necesario
        ];

        // Insertar los datos en la tabla
        DB::table('producto_carrito')->insert($data);
    }
}
