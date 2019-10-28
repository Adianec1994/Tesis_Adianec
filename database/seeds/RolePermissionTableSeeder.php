<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionTableSeeder extends Seeder
{
    /**
     * Devolver el permiso si ya existe, si no, crearlo
     * @param {String} $name nombre del permiso
     * @return {Permission}
     */
    private function getPermission(String $name)
    {
        $permission = Permission::where('name', $name)->first();
        if (!$permission) {
            $permission = Permission::create(['name' => $name]);
        }
        return $permission;
    }

    /**
     * Asignar permisos a un rol
     * @param {String} $RoleName Nombre del rol
     * @param {array} $Permissions Permisos asociados al rol
     */
    private function assign(String $RoleName, array $Permissions)
    {
        $Role = Role::create(['name' => $RoleName]);

        foreach ($Permissions as $permission) {
            $Role->givePermissionTo($this->getPermission($permission));
        }
    }
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
            'create_usuario',
            'read_usuario',
            'update_usuario',
            'delete_usuario',
            'read_traza',
            'importar_exportar'
        ];

        $this->assign('Administrador', $adminPermissions);

        //permisos especialistaCDN
        $especialistaCDNPermissions = [
            'read_entidad',
            'read_provincia',
            'read_central',
            'read_bateria',
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

        $this->assign('Especialista CDN', $especialistaCDNPermissions);

        //permisos especialistaUEB
        $especialistaUEBPermissions = [
            'read_entidad',
            'read_provincia',
            'read_central',
            'read_bateria',
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
            /* 'create_mantenimiento',
            'read_mantenimiento',
            'update_mantenimiento',
            'delete_mantenimiento',
            /*'create_parte_diario_ueb',
            'exportar_parte_diario_ueb',*/
        ];

        $this->assign('Especialista UEB', $especialistaUEBPermissions);

        //permisos directorCDN
        $directorCDNPermissions = [
            /* 'create_parte_diario_nac',
            'exportar_parte_diario_nac',*/
            'read_reporte',
            'read_usuario',
            'read_traza',
            'read_entidad',
            'read_provincia',
            'read_central',
            'read_bateria',
            'read_grupo',
        ];

        $this->assign('Director CDN', $directorCDNPermissions);

        //permisos directorUEB
        $directorUEBPermissions = [
            'read_reporte',
        ];

        $this->assign('Director UEB', $directorUEBPermissions);

        //permisos directivo
        $directivoPermissions = [
            'read_reporte',
        ];

        $this->assign('Directivo', $directivoPermissions);

        //permisos de desarrollo (todos los permisos)
        //eliminar este rol en producción
        $developerPermissions = array_merge(
            $adminPermissions,
            $especialistaCDNPermissions,
            $especialistaUEBPermissions,
            $directorCDNPermissions,
            $directorUEBPermissions,
            $directivoPermissions
        );
        $this->assign('Desarrollo', $developerPermissions);
    }
}
