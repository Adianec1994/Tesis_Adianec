<?php

namespace App\Repositories;

use App\Models\HechosExtraordinarios;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class HechosExtraordinariosRepository
 * @package App\Repositories
 * @version May 24, 2019, 5:44 pm UTC
 *
 * @method HechosExtraordinarios findWithoutFail($id, $columns = ['*'])
 * @method HechosExtraordinarios find($id, $columns = ['*'])
 * @method HechosExtraordinarios first($columns = ['*'])
*/
class HechosExtraordinariosRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'tipo',
        'fecha',
        'hora',
        'descripcion',
        'medidas',
        'nombreImplicado',
        'nombreInforma',
        'entidads_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return HechosExtraordinarios::class;
    }
}
