<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Producto::factory(15)->create();
        DB::table('productos')->insert([
            'categoria_id' => 1,
            'nombre' => 'Camiseta básica',
            'descripcion' => 'Camiseta de manga corta blanca',
            'precio' => 15.99,
            'imagen' => '\public\storage\camisetas\camiseta4.jpg',
            'talla' => 'M',
            'stock' => 100,
            'color' => 'Blanco',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('productos')->insert([
            'categoria_id' => 1,
            'nombre' => 'Camiseta León',
            'descripcion' => 'Camiseta de manga corta blanca y negra con dibujo de león en el centro',
            'precio' => 15.99,
            'imagen' => '\public\storage\camisetas\camiseta5.jpg',
            'talla' => 'M',
            'stock' => 100,
            'color' => 'Blanca',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('productos')->insert([
            'categoria_id' => 1,
            'nombre' => 'Camiseta básica',
            'descripcion' => 'Camiseta de manga corta azul',
            'precio' => 16.99,
            'imagen' => '\public\storage\camisetas\camiseta2.jpg',
            'talla' => 'M',
            'stock' => 50,
            'color' => 'Azul',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('productos')->insert([
            'categoria_id' => 1,
            'nombre' => 'Camiseta básica',
            'descripcion' => 'Camiseta de manga corta negra',
            'precio' => 16.99,
            'imagen' => '\public\storage\camisetas\camiseta1.jpg',
            'talla' => 'M',
            'stock' => 100,
            'color' => 'Negra',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('productos')->insert([
            'categoria_id' => 2,
            'nombre' => 'Sudadera básica',
            'descripcion' => 'Sudadera de manga larga multicolor',
            'precio' => 22.99,
            'imagen' => '\public\storage\sudaderas\sudadera1.jpg',
            'talla' => 'XS',
            'stock' => 100,
            'color' => 'Multicolor',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        DB::table('productos')->insert([
            'categoria_id' => 2,
            'nombre' => 'Sudadera básica',
            'descripcion' => 'Sudadera de manga larga gris',
            'precio' => 22.99,
            'imagen' => '\public\storage\sudaderas\sudadera2.jpg',
            'talla' => 'XL',
            'stock' => 100,
            'color' => 'Gris',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('productos')->insert([
            'categoria_id' => 2,
            'nombre' => 'Sudadera básica',
            'descripcion' => 'Sudadera de manga larga gris',
            'precio' => 22.99,
            'imagen' => '\public\storage\sudaderas\sudadera3.jpg',
            'talla' => 'M',
            'stock' => 100,
            'color' => 'Gris',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('productos')->insert([
            'categoria_id' => 2,
            'nombre' => 'Sudadera básica',
            'descripcion' => 'Sudadera de manga larga azul',
            'precio' => 22.99,
            'imagen' => '\public\storage\sudaderas\sudadera4.jpg',
            'talla' => 'M',
            'stock' => 100,
            'color' => 'Azul',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('productos')->insert([
            'categoria_id' => 3,
            'nombre' => 'Pantalón básico',
            'descripcion' => 'Pantalón de tela marrón',
            'precio' => 25.99,
            'imagen' => '\public\storage\pantalones\pantalon1.jpg',
            'talla' => 'M',
            'stock' => 100,
            'color' => 'Marrón',
            'created_at' => now(),
            'updated_at' => now(),
            
        ]);

        DB::table('productos')->insert([
            'categoria_id' => 3,
            'nombre' => 'Pantalón básico',
            'descripcion' => 'Pantalón de tela rojo',
            'precio' => 25.99,
            'imagen' => '\public\storage\pantalones\pantalon2.jpg',
            'talla' => 'M',
            'stock' => 100,
            'color' => 'Rojo',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('productos')->insert([
            'categoria_id' => 3,
            'nombre' => 'Pantalón básico',
            'descripcion' => 'Pantalón de tela marrón',
            'precio' => 25.99,
            'imagen' => '\public\storage\pantalones\pantalon3.jpg',
            'talla' => 'M',
            'stock' => 100,
            'color' => 'Marrón',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('productos')->insert([
            'categoria_id' => 3,
            'nombre' => 'Pantalón básico',
            'descripcion' => 'Pantalón de tela multicolor',
            'precio' => 25.99,
            'imagen' => '\public\storage\pantalones\pantalon4.jpg',
            'talla' => 'M',
            'stock' => 100,
            'color' => 'Multicolor',
            'created_at' => now(),
            'updated_at' => now(),
        ]);


    }
}
