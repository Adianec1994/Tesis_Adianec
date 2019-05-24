<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Entidad
 * @package App\Models
 * @version May 24, 2019, 12:37 am UTC
 *
 * @property \App\Models\Provincia provincias
 * @property \Illuminate\Database\Eloquent\Collection centralElectricas
 * @property \Illuminate\Database\Eloquent\Collection disponibilidads
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection hechosExtraordinarios
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection plans
 * @property \Illuminate\Database\Eloquent\Collection users
 * @property string nombre
 * @property float potInstalada
 * @property string ip
 * @property integer provincias_id
 */
class Entidad extends Model
{
    use SoftDeletes;

    public $table = 'entidads';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nombre',
        'potInstalada',
        'ip',
        'provincias_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string',
        'potInstalada' => 'float',
        'ip' => 'string',
        'provincias_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'provincias_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function provincias()
    {
        return $this->belongsTo(\App\Models\Provincia::class, 'provincias_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function centralElectricas()
    {
        return $this->hasMany(\App\Models\CentralElectrica::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function disponibilidads()
    {
        return $this->hasMany(\App\Models\Disponibilidad::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function hechosExtraordinarios()
    {
        return $this->hasMany(\App\Models\HechosExtraordinario::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function plans()
    {
        return $this->hasMany(\App\Models\Plan::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function users()
    {
        return $this->hasMany(\App\Models\User::class);
    }
}
