<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Proveedor
 * @package App\Models
 * @version May 21, 2019, 3:57 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection grupos
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property string marca
 * @property integer serie
 * @property string pais
 */
class Proveedor extends Model
{
    use SoftDeletes;

    public $table = 'proveedors';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'marca',
        'serie',
        'pais',
        'nombre'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'marca' => 'string',
        'serie' => 'string',
        'pais' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function grupos()
    {
        return $this->hasMany(\App\Models\Grupo::class);
    }
}
