<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Direccion;
use Illuminate\Support\Facades\DB;

class DireccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Direccion::factory(15)->create();

        DB::table('direcciones')->insert([
            'user_id' => 2,
            'calle' => 'Calle de la Rosa',
            'numero' => 12,
            'piso' => 1,
            'puerta' => 'A',
            'codigo_postal' => '28001',
            'ciudad' => 'Madrid',
            'provincia' => 'Madrid',
            'pais' => 'España',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('direcciones')->insert([
            'user_id' => 3,
            'calle' => 'Calle de la Luna',
            'numero' => 5,
            'piso' => 2,
            'puerta' => 'B',
            'codigo_postal' => '28002',
            'ciudad' => 'Madrid',
            'provincia' => 'Madrid',
            'pais' => 'España',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('direcciones')->insert([
            'user_id' => 4,
            'calle' => 'Calle del Sol',
            'numero' => 8,
            'piso' => 3,
            'puerta' => 'C',
            'codigo_postal' => '28003',
            'ciudad' => 'Madrid',
            'provincia' => 'Madrid',
            'pais' => 'España',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
