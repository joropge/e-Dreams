<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PedidoCarritoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Array de datos de prueba para la tabla pivot pedido_carrito
        $data = [
            ['pedido_id' => 1, 'carrito_id' => 1],
            ['pedido_id' => 2, 'carrito_id' => 1],
            ['pedido_id' => 3, 'carrito_id' => 2],
            // Agrega más datos aquí según sea necesario
        ];

        // Insertar los datos en la tabla
        DB::table('pedido_carrito')->insert($data);
    }
}
