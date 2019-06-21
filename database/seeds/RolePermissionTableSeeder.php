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
        //permisos administrador
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
          'create_brigada',
          'read_brigada',
          'update_brigada',
          'delete_brigada',
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
    //permisos especialistaCDN
        $especialistaCDNPermissions = [
           'create_disponibilidad',
           'read_disponibilidad',
           'update_disponibilidad',
           'delete_disponibilidad',
           'create_plan',
           'read_plan',
           'update_plan',
           'delete_plan',
           'create_hecho_extraordinario',
           'read_hecho_extraordinario',
           'update_hecho_extraordinario',
           'delete_hecho_extraordinario',
           'create_dato_general',
           'read_dato_general',
           'update_dato_general',
           'delete_dato_general',
           'create_cobertura_combustible',
           'read_cobertura_combustible',
           'update_cobertura_combustible',
           'delete_cobertura_combustible',
           'create_paila',
           'read_paila',
           'update_paila',
           'delete_paila',
           'create_operador',
           'read_operador',
           'update_operador',
           'delete_operador',
           'create_evento_diario',
           'read_evento_diario',
           'update_evento_diario',
           'delete_evento_diario',
           'create_generacion',
           'read_generacion',
           'update_generacion',
           'delete_generacion',
           'create_mantenimiento',
           'read_mantenimiento',
           'update_mantenimiento',
           'delete_mantenimiento',
           'create_parte_diario_nac',
           'exportar_parte_diario_nac',
        ];

        $especialistaCDNRole = Role::create(['name' => 'Especialista CDN']);

        foreach ($especialistaCDNPermissions as $permission) {
            $especialistaCDNRole->givePermissionTo(Permission::create(['name' => $permission]));
        }

        //permisos especialistaUEB
        $especialistaUEBPermissions = [
            'create_hecho_extraordinario',
            'read_hecho_extraordinario',
            'update_hecho_extraordinario',
            'delete_hecho_extraordinario',
            'create_dato_general',
            'read_dato_general',
            'update_dato_general',
            'delete_dato_general',
            'create_cobertura_combustible',
            'read_cobertura_combustible',
            'update_cobertura_combustible',
            'delete_cobertura_combustible',
            'create_paila',
            'read_paila',
            'update_paila',
            'delete_paila',
            'create_operador',
            'read_operador',
            'update_operador',
            'delete_operador',
            'create_evento_diario',
            'read_evento_diario',
            'update_evento_diario',
            'delete_evento_diario',
            'create_generacion',
            'read_generacion',
            'update_generacion',
            'delete_generacion',
            'create_mantenimiento',
            'read_mantenimiento',
            'update_mantenimiento',
            'delete_mantenimiento',
            'create_parte_diario_ueb',
            'exportar_parte_diario_ueb',
        ];

        $especialistaUEBRole = Role::create(['name' => 'Especialista UEB']);

        foreach ($especialistaUEBPermissions as $permission) {
            $especialistaUEBRole->givePermissionTo(Permission::create(['name' => $permission]));
        }

        //permisos directorCDN
        $directorCDNPermissions = [
            'create_parte_diario_nac',
            'exportar_parte_diario_nac',
            'read_reporte',
            'read_traza',
        ];

        $directorCDNRole = Role::create(['name' => 'Director CDN']);

        foreach ($directorCDNPermissions as $permission) {
            $directorCDNRole->givePermissionTo(Permission::create(['name' => $permission]));
        }

        //permisos directorUEB
        $directorUEBPermissions = [
            'read_reporte',
        ];

        $directorUEBRole = Role::create(['name' => 'Director UEB']);

        foreach ($directorUEBPermissions as $permission) {
            $directorUEBRole->givePermissionTo(Permission::create(['name' => $permission]));
        }

        //permisos directivo
        $directivoPermissions = [
            'read_reporte',
        ];

        $directivoRole = Role::create(['name' => 'Directivo']);

        foreach ($directivoPermissions as $permission) {
            $directivoRole->givePermissionTo(Permission::create(['name' => $permission]));
        }

    }
}
