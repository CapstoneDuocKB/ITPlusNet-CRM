<?php

namespace Database\Seeders;

use App\Models\Usuario;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Usuario::factory(10)->create();

        Usuario::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'rut' => '12345678-9', // Añadir el campo 'rut'
            'password' => bcrypt('password'), // Contraseña encriptada
            'telefono' => '123456789',
            'direccion_id' => null, // Puedes cambiar esto por una dirección válida si la tienes
            'empresa_id' => null, // Puedes cambiar esto por una empresa válida si la tienes
            'activo' => true,
        ]);
    }
}