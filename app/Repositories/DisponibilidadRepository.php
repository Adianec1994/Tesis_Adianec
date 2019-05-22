<?php

namespace App\Repositories;

use App\Models\Disponibilidad;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DisponibilidadRepository
 * @package App\Repositories
 * @version May 22, 2019, 3:58 am UTC
 *
 * @method Disponibilidad findWithoutFail($id, $columns = ['*'])
 * @method Disponibilidad find($id, $columns = ['*'])
 * @method Disponibilidad first($columns = ['*'])
*/
class DisponibilidadRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'fecha',
        'potInstaladaReal',
        'potDisponibleReal',
        'entidads_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Disponibilidad::class;
    }
}
