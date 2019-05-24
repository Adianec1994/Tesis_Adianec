<?php

namespace App\Repositories;

use App\Models\Entidad;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class EntidadRepository
 * @package App\Repositories
 * @version May 24, 2019, 12:37 am UTC
 *
 * @method Entidad findWithoutFail($id, $columns = ['*'])
 * @method Entidad find($id, $columns = ['*'])
 * @method Entidad first($columns = ['*'])
*/
class EntidadRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'potInstalada',
        'ip',
        'provincias_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Entidad::class;
    }
}
