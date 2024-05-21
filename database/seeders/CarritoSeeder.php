<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Carrito;
use Illuminate\Support\Facades\DB;

class CarritoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Carrito::factory(15)->create();

        // DB::table('carritos')->insert([
        //     'usuario_id' => 2,
        //     'producto_id' => 1,
        //     'cantidad' => 2,
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);

        // DB::table('carritos')->insert([
        //     'usuario_id' => 3,
        //     'producto_id' => 2,
        //     'cantidad' => 3,
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);

        // DB::table('carritos')->insert([
        //     'usuario_id' => 4,
        //     'producto_id' => 3,
        //     'cantidad' => 4,
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);
    }
}
