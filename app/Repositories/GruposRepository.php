<?php

namespace App\Repositories;

use App\Models\Grupos;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class GruposRepository
 * @package App\Repositories
 * @version May 29, 2019, 2:22 pm UTC
 *
 * @method Grupos findWithoutFail($id, $columns = ['*'])
 * @method Grupos find($id, $columns = ['*'])
 * @method Grupos first($columns = ['*'])
*/
class GruposRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'numero',
        'potInstalada',
        'baterias_id',
        'proveedors_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Grupos::class;
    }
}
