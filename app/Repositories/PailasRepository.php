<?php

namespace App\Repositories;

use App\Models\Pailas;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PailasRepository
 * @package App\Repositories
 * @version May 29, 2019, 2:09 pm UTC
 *
 * @method Pailas findWithoutFail($id, $columns = ['*'])
 * @method Pailas find($id, $columns = ['*'])
 * @method Pailas first($columns = ['*'])
*/
class PailasRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'fecha',
        'hora',
        'combustibleFactura',
        'combustibleMedicion',
        'acciones',
        'central_electricas_id',
        'operadors_id',
        'chofer_id',
        'acompanante_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Pailas::class;
    }
}
