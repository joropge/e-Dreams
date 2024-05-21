<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Insertar usuario administrador
        DB::table('users')->insert([
            'name' => 'admin',
            'apellidos' => 'Admin Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('12345678'), // Recuerda siempre cifrar las contraseñas
            'rol' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insertar usuarios normales
        DB::table('users')->insert([
            'name' => 'usu1',
            'apellidos' => 'Usuario1 Usuario1',
            'email' => 'usuario1@example.com',
            'password' => Hash::make('12345678'),
            'rol' => 'user',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => 'usu2',
            'apellidos' => 'Usuario2 Usuario2',
            'email' => 'usuario2@example.com',
            'password' => Hash::make('12345678'),
            'rol' => 'user',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => 'usu3',
            'apellidos' => 'Usuario3 Usuario3',
            'email' => 'usuario3@example.com',
            'password' => Hash::make('12345678'),
            'rol' => 'user',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
