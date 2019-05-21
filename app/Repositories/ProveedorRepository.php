<?php

namespace App\Repositories;

use App\Models\Proveedor;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProveedorRepository
 * @package App\Repositories
 * @version May 21, 2019, 3:57 pm UTC
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
        'pais'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Proveedor::class;
    }
}
