<?php

namespace App\Repositories;

use App\Models\Mantenimiento;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class MantenimientoRepository
 * @package App\Repositories
 * @version June 4, 2019, 2:21 am UTC
 *
 * @method Mantenimiento findWithoutFail($id, $columns = ['*'])
 * @method Mantenimiento find($id, $columns = ['*'])
 * @method Mantenimiento first($columns = ['*'])
*/
class MantenimientoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'fechaMtto',
        'tipoTrabajo',
        'horaEntrada',
        'horaSalida',
        'informa',
        'resultado',
        'mantenedores_externos_id',
        'brigadas_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Mantenimiento::class;
    }
}
