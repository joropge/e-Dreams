<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\DireccionSeeder;
use Database\Seeders\ProductoSeeder;
use Database\Seeders\PedidoSeeder;
use Database\Seeders\CarritoSeeder;
use Database\Seeders\CategoriaSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        

        $this->call([
            CategoriaSeeder::class,
            UserSeeder::class,
            DireccionSeeder::class,
            ProductoSeeder::class,
            PedidoSeeder::class,
            CarritoSeeder::class,
        ]);

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
