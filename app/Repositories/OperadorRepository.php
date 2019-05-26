<?php

namespace App\Repositories;

use App\Models\Operador;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class OperadorRepository
 * @package App\Repositories
 * @version May 26, 2019, 6:19 am UTC
 *
 * @method Operador findWithoutFail($id, $columns = ['*'])
 * @method Operador find($id, $columns = ['*'])
 * @method Operador first($columns = ['*'])
*/
class OperadorRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'cidentidad',
        'ocupacion'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Operador::class;
    }
}
