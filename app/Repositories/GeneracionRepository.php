<?php

namespace App\Repositories;

use App\Models\Generacion;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class GeneracionRepository
 * @package App\Repositories
 * @version June 4, 2019, 2:21 am UTC
 *
 * @method Generacion findWithoutFail($id, $columns = ['*'])
 * @method Generacion find($id, $columns = ['*'])
 * @method Generacion first($columns = ['*'])
*/
class GeneracionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'fecha',
        'horaEntrada',
        'horaSalida',
        'reportadoPor',
        'tiempoOperacion',
        'grupos_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Generacion::class;
    }
}
