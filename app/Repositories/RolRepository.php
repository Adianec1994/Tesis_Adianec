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

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Role::class;
    }
}
