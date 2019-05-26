<?php

namespace App\Repositories;

use App\Models\DatosGenerales;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DatosGeneralesRepository
 * @package App\Repositories
 * @version May 26, 2019, 4:25 am UTC
 *
 * @method DatosGenerales findWithoutFail($id, $columns = ['*'])
 * @method DatosGenerales find($id, $columns = ['*'])
 * @method DatosGenerales first($columns = ['*'])
*/
class DatosGeneralesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'genBruta',
        'insumos',
        'recibido',
        'volumenRecibido',
        'consumoGeneracion',
        'densidadPonderada',
        'temperatura',
        'densidadCorreccion',
        'valorCalorico',
        'existencia',
        'cobertura',
        'indiceConsumo',
        'lubricteRecibido',
        'lubricteCsmoReposicion',
        'lubricteCsmoCambio',
        'lubricteCsmoTotal',
        'lubricteExistencia',
        'lubricteCobertura',
        'lubricteIndiceCsmo',
        'refrigteRecibido',
        'refrigteConsumo',
        'refrigteExistencia',
        'central_electricas_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return DatosGenerales::class;
    }
}
