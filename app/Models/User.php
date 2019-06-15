<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class User
 * @package App\Models
 * @version June 15, 2019, 12:58 pm UTC
 *
 * @property \App\Models\Entidad entidads
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection trazas
 * @property string name
 * @property string cargo
 * @property string username
 * @property string email
 * @property string password
 * @property string imagen
 * @property boolean accepted
 * @property integer entidads_id
 */
class User extends Model
{
    use SoftDeletes;

    public $table = 'users';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'cargo',
        'username',
        'email',
        'password',
        'imagen',
        'accepted',
        'entidads_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'cargo' => 'string',
        'username' => 'string',
        'email' => 'string',
        'password' => 'string',
        'imagen' => 'string',
        'accepted' => 'boolean',
        'entidads_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|max:30',
        'cargo' => 'required',
        'username' => 'required|max:15',
        'email' => 'required|email|max:255',
        'accepted' => 'required',
        'entidads_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function entidads()
    {
        return $this->belongsTo(\App\Models\Entidad::class, 'entidads_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function trazas()
    {
        return $this->hasMany(\App\Models\Traza::class);
    }
}
