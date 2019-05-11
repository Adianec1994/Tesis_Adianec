<?php

namespace App\Repositories;

use App\Models\Proveedor;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProveedorRepository
 * @package App\Repositories
 * @version May 8, 2019, 6:15 am UTC
 *
 * @method Proveedor findWithoutFail($id, $columns = ['*'])
 * @method Proveedor find($id, $columns = ['*'])
 * @method Proveedor first($columns = ['*'])
*/
class ProveedorRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'marca',
        'serie',
        'paiss_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Proveedor::class;
    }
}
