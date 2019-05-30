<?php

namespace App\Repositories;

use App\Models\MantenedorExterno;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class MantenedorExternoRepository
 * @package App\Repositories
 * @version May 30, 2019, 2:53 pm UTC
 *
 * @method MantenedorExterno findWithoutFail($id, $columns = ['*'])
 * @method MantenedorExterno find($id, $columns = ['*'])
 * @method MantenedorExterno first($columns = ['*'])
*/
class MantenedorExternoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'numeroContrato',
        'fechaInicio',
        'fechaFin'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return MantenedorExterno::class;
    }
}
