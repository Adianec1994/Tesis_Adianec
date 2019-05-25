<?php

namespace App\Repositories;

use App\Models\CoberturaCombustible;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CoberturaCombustibleRepository
 * @package App\Repositories
 * @version May 25, 2019, 3:18 am UTC
 *
 * @method CoberturaCombustible findWithoutFail($id, $columns = ['*'])
 * @method CoberturaCombustible find($id, $columns = ['*'])
 * @method CoberturaCombustible first($columns = ['*'])
*/
class CoberturaCombustibleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'planReserva',
        'fondaje',
        'existOperativa',
        'coberturaHoras',
        'consumo',
        'suminCupet',
        'capacTotalAlmac',
        'capacVacio',
        'existTotalDiaAnterior',
        'central_electricas_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CoberturaCombustible::class;
    }
}
