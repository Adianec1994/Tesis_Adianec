<?php

namespace App\Repositories;

use App\Models\Planes;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PlanesRepository
 * @package App\Repositories
 * @version May 24, 2019, 8:27 pm UTC
 *
 * @method Planes findWithoutFail($id, $columns = ['*'])
 * @method Planes find($id, $columns = ['*'])
 * @method Planes first($columns = ['*'])
*/
class PlanesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'anno',
        'mes',
        'generacion',
        'indiceConsumoCombustible',
        'compromiso',
        'entidads_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Planes::class;
    }
}
