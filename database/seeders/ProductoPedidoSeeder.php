<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoPedidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Array de datos de prueba para la tabla pivot producto_pedido
        $data = [
            ['producto_id' => 1, 'pedido_id' => 1],
            ['producto_id' => 2, 'pedido_id' => 1],
            ['producto_id' => 3, 'pedido_id' => 2],
            // Agrega más datos aquí según sea necesario
        ];

        // Insertar los datos en la tabla
        DB::table('producto_pedido')->insert($data);
    }
}
