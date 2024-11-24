<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;
use Spatie\Permission\Models\Role;
use App\Models\EstadoSoporte;
use App\Models\TipoSoporte;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StartupSeeder extends Seeder
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
            ['email' => 'ali.gonzalezqa@gmail.com'],
            [
                'rut' => '21.012.942-1',
                'name' => 'Alister Gonzalez',
                'password' => Hash::make('Whyth$1005'),
                'telefono' => '1234567890',
                'direccion_id' => null,
                'empresa_id' => null,
                'activo' => true,
                'id' => Str::uuid()->toString(),
                'sucursal_id' => 1,
                'caja_id' => 12,
                'bodega_id' => 1,
            ]
        );
        $admin->assignRole('Cliente');

        // 2. Soporte Técnico
        $soporte = Usuario::firstOrCreate(
            ['email' => 'lh.espinoza@duocuc.cl'],
            [
                'rut' => '21.000.501-3',
                'name' => 'Lhian Espinoza',
                'password' => Hash::make('password123'),
                'telefono' => '+56972192537',
                'direccion_id' => null,
                'empresa_id' => null,
                'activo' => true,
                'id' => Str::uuid()->toString(),
                'sucursal_id' => 1,
                'caja_id' => 12,
                'bodega_id' => 1,
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
                'sucursal_id' => 1,
                'caja_id' => 12,
                'bodega_id' => 1,
            ]
        );
        $cliente->assignRole('Cliente');

        // Crear estados de soporte si no existen
        $estadosSoporte = [
            'ABIERTO',
            'PENDIENTE',
            'EN DESARROLLO',
            'CERRADO',
        ];

        foreach ($estadosSoporte as $estado) {
            EstadoSoporte::firstOrCreate(
                ['nombre' => $estado],
                [
                    'id' => Str::uuid()->toString(),
                    'descripcion' => null,
                ]
            );
        }

        // Crear tipos de soporte si no existen
        $tiposSoporte = [
            'DESARROLLO',
            'INSTALACIÓN',
            'SOPORTE',
            'CAPACITACIÓN',
        ];

        foreach ($tiposSoporte as $tipo) {
            TipoSoporte::firstOrCreate(
                ['nombre' => $tipo],
                [
                    'id' => Str::uuid()->toString(),
                    'descripcion' => null,
                ]
            );
        }
    }
}
