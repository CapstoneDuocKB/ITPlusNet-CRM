<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RolesAndUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear roles si no existen
        $roles = ['Gerente', 'SoporteTecnico', 'Administrador', 'Cliente'];
        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }

        // Crear usuarios y asignar roles

        // 1. Administrador (Administrador)
        $admin = Usuario::firstOrCreate(
            ['email' => 'ali.gonzalezqa@gmail.com'], // Asegúrate de que el email sea único
            [
                'rut' => '21.012.942-1',
                'name' => 'Alister Gonzalez',
                'password' => Hash::make('Whyth$1005'), // Cambia la contraseña según sea necesario
                'telefono' => '1234567890',
                'direccion_id' => null, // Ajusta según tus necesidades
                'empresa_id' => null, // Ajusta según tus necesidades
                'activo' => true,
                'id' => Str::uuid()->toString(), // Genera un UUID
            ]
        );
        $admin->assignRole('Administrador');

        // 2. Soporte Técnico
        $soporte = Usuario::firstOrCreate(
            ['email' => 'soporte@itplusnet.com'],
            [
                'rut' => '12.345.678-9',
                'name' => 'Juan Perez',
                'password' => Hash::make('password123'),
                'telefono' => '0987654321',
                'direccion_id' => null,
                'empresa_id' => null,
                'activo' => true,
                'id' => Str::uuid()->toString(),
            ]
        );
        $soporte->assignRole('SoporteTecnico');

        // 3. Cliente
        $cliente = Usuario::firstOrCreate(
            ['email' => 'cliente@itplusnet.com'],
            [
                'rut' => '9.876.543-2',
                'name' => 'Maria Lopez',
                'password' => Hash::make('password123'),
                'telefono' => '1122334455',
                'direccion_id' => null,
                'empresa_id' => null,
                'activo' => true,
                'id' => Str::uuid()->toString(),
            ]
        );
        $cliente->assignRole('Cliente');
    }
}
