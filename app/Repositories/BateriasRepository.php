<?php

namespace App\Repositories;

use App\Models\Baterias;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class BateriasRepository
 * @package App\Repositories
 * @version May 25, 2019, 2:42 am UTC
 *
 * @method Baterias findWithoutFail($id, $columns = ['*'])
 * @method Baterias find($id, $columns = ['*'])
 * @method Baterias first($columns = ['*'])
*/
class BateriasRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'numero',
        'potInstalada',
        'central_electricas_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Baterias::class;
    }
}
