<?php

namespace App\Repositories;

use App\Models\Brigada;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class BrigadaRepository
 * @package App\Repositories
 * @version May 21, 2019, 3:57 pm UTC
 *
 * @method Brigada findWithoutFail($id, $columns = ['*'])
 * @method Brigada find($id, $columns = ['*'])
 * @method Brigada first($columns = ['*'])
*/
class BrigadaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'numero',
        'cantidadTrabajadores'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Brigada::class;
    }
}
