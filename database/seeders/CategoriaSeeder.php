<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Categoria::factory(15)->create();
        DB::table('categorias')->insert([
            ['nombre' => 'Camisetas', 'descripcion' => 'Camisetas de diferentes colores y tallas', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Sudaderas', 'descripcion' => 'Sudaderas de diferentes colores y tallas', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Pantalones', 'descripcion' => 'Pantalones de diferentes colores y tallas', 'created_at' => now(), 'updated_at' => now()],
        ]);
        
    }
}
