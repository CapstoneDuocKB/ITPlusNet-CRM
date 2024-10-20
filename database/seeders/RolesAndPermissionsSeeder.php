<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Restablecer la caché de roles y permisos
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Definir los modelos
        $models = [
            'regiones', 'comunas', 'direcciones', 'empresas', 'usuarios', 'sucursales',
            'bodegas', 'cajas', 'dificultades_soporte', 'estados_soporte', 'tipos_soporte', 'soportes'
        ];

        // Definir las acciones
        $actions = ['crear', 'ver', 'editar', 'eliminar', 'listar'];

        // Crear permisos
        foreach ($models as $model) {
            foreach ($actions as $action) {
                // Ajustes para el rol Cliente y Soporte en 'soportes'
                if ($model == 'soportes' && $action == 'eliminar') {
                    continue; // Cliente y Soporte no pueden eliminar soportes
                }
                Permission::firstOrCreate(['name' => "$action $model"]);
            }
        }

        // Crear roles
        $adminRole = Role::firstOrCreate(['name' => 'Administrador']);
        $soporteRole = Role::firstOrCreate(['name' => 'Soporte']);
        $clienteRole = Role::firstOrCreate(['name' => 'Cliente']);

        // Asignar todos los permisos al Administrador
        $adminRole->givePermissionTo(Permission::all());

        // Permisos para el rol Soporte
        $soportePermissions = [];

        // Soporte puede 'crear', 'ver', 'editar', 'eliminar', 'listar' en los siguientes modelos
        $soporteModels = [
            'regiones', 'comunas', 'direcciones', 'empresas', 'usuarios', 'sucursales',
            'bodegas', 'cajas', 'dificultades_soporte', 'estados_soporte', 'tipos_soporte'
        ];
        foreach ($soporteModels as $model) {
            foreach ($actions as $action) {
                $soportePermissions[] = "$action $model";
            }
        }

        // Soporte puede 'listar', 'ver', 'editar' en 'soportes'
        foreach (['listar', 'ver', 'editar'] as $action) {
            $soportePermissions[] = "$action soportes";
        }

        $soporteRole->givePermissionTo($soportePermissions);

        // Permisos para el rol Cliente
        $clientePermissions = [];

        // Cliente puede 'crear', 'ver', 'listar', 'editar' en 'soportes'
        foreach (['crear', 'ver', 'listar', 'editar'] as $action) {
            $clientePermissions[] = "$action soportes";
        }

        $clienteRole->givePermissionTo($clientePermissions);
    }
}
