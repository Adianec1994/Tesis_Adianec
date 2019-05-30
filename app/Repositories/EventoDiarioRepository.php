<?php

namespace App\Repositories;

use App\Models\EventoDiario;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class EventoDiarioRepository
 * @package App\Repositories
 * @version May 30, 2019, 12:38 am UTC
 *
 * @method EventoDiario findWithoutFail($id, $columns = ['*'])
 * @method EventoDiario find($id, $columns = ['*'])
 * @method EventoDiario first($columns = ['*'])
*/
class EventoDiarioRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'estado',
        'fechaEvento',
        'fechaPosibleSolucion',
        'fechaReporte',
        'fechaDiagnostico',
        'fechaSolucion',
        'horas',
        'sistema',
        'subSistema',
        'parte',
        'fallo',
        'diagnosticoPreliminar',
        'diagnostico',
        'responsable',
        'insertadoPor',
        'grupos_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return EventoDiario::class;
    }
}
