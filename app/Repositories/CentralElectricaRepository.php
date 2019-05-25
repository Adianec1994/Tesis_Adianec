<?php

namespace App\Repositories;

use App\Models\CentralElectrica;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CentralElectricaRepository
 * @package App\Repositories
 * @version May 25, 2019, 1:08 am UTC
 *
 * @method CentralElectrica findWithoutFail($id, $columns = ['*'])
 * @method CentralElectrica find($id, $columns = ['*'])
 * @method CentralElectrica first($columns = ['*'])
*/
class CentralElectricaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'potInstalada',
        'entidads_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CentralElectrica::class;
    }
}
