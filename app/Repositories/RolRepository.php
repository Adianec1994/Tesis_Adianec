<?php

namespace App\Repositories;

use Spatie\Permission\Models\Role;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class RolRepository
 * @package App\Repositories
 * @version June 15, 2019, 4:18 pm UTC
 *
 * @method Rol findWithoutFail($id, $columns = ['*'])
 * @method Rol find($id, $columns = ['*'])
 * @method Rol first($columns = ['*'])
 */
class RolRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'guard_name'
    ];

    public function nameChangedPermissions($permissions)
    {
        $response = [];
        foreach ($permissions as $value) {
            list($action, $model) = explode("_", $value->name, 2);
            switch ($action) {
                case 'create':
                    $permission = 'crear ' . $model;
                    break;
                case 'read':
                    $permission = 'leer ' . $model;
                    break;
                case 'update':
                    $permission = 'actualizar ' . $model;
                    break;
                case 'delete':
                    $permission = 'eliminar ' . $model;
                    break;
            }
            $permission = str_replace('_', ' ', $permission);
            $response[] = [
                'name' => $permission,
                'id' => $value->id
            ];
        }
        return $response;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Role::class;
    }
}
