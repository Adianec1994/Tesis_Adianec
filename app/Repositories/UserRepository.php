<?php

namespace App\Repositories;

use App\Models\User;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserRepository
 * @package App\Repositories
 * @version June 15, 2019, 12:58 pm UTC
 *
 * @method User findWithoutFail($id, $columns = ['*'])
 * @method User find($id, $columns = ['*'])
 * @method User first($columns = ['*'])
*/
class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'cargo',
        'username',
        'email',
        'password',
        'imagen',
        'accepted',
        'entidads_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }
}
