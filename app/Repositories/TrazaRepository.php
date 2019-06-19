<?php

namespace App\Repositories;

use App\Models\Traza;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class TrazaRepository
 * @package App\Repositories
 * @version June 18, 2019, 7:46 pm CDT
 *
 * @method Traza findWithoutFail($id, $columns = ['*'])
 * @method Traza find($id, $columns = ['*'])
 * @method Traza first($columns = ['*'])
*/
class TrazaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'accion',
        'ip',
        'url',
        'users_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Traza::class;
    }
}
