<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminPermissions = [
          'create_entidad',
          'read_entidad',
          'update_entidad',
          'delete_entidad',
          'create_provincia',
          'read_provincia',
          'update_provincia',
          'delete_provincia',
          'create_central',
          'read_central',
          'update_central',
          'delete_central',
          'create_bateria',
          'read_bateria',
          'update_bateria',
          'delete_bateria',
          'create_grupo',
          'read_grupo',
          'update_grupo',
          'delete_grupo',
          'create_proveedor',
          'read_proveedor',
          'update_proveedor',
          'delete_proveedor',
          'create_mantenedor_externo',
          'read_mantenedor_externo',
          'update_mantenedor_externo',
          'delete_mantenedor_externo',
          'create_usuario',
          'read_usuario',
          'update_usuario',
          'delete_usuario',
          'read_traza',
          'importar_exportar'
        ];

        $adminRole = Role::create(['name' => 'Administrador']);

        foreach ($adminPermissions as $permission) {
            $adminRole->givePermissionTo(Permission::create(['name' => $permission]));
        }
    }
}
