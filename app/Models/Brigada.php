<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Brigada
 * @package App\Models
 * @version May 21, 2019, 3:57 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection grupos
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property integer numero
 * @property integer cantidadTrabajadores
 */
class Brigada extends Model
{
    use SoftDeletes;

    public $table = 'brigadas';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'numero',
        'cantidadTrabajadores'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'numero' => 'integer',
        'cantidadTrabajadores' => 'integer'
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
    public function mantenimientos()
    {
        return $this->hasMany(\App\Models\Mantenimiento::class);
    }
}
