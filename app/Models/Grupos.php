<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Grupos
 * @package App\Models
 * @version May 29, 2019, 2:22 pm UTC
 *
 * @property \App\Models\Bateria baterias
 * @property \App\Models\Proveedor proveedors
 * @property \Illuminate\Database\Eloquent\Collection eventosDiarios
 * @property \Illuminate\Database\Eloquent\Collection generacions
 * @property \Illuminate\Database\Eloquent\Collection mantenimientos
 * @property \Illuminate\Database\Eloquent\Collection
 * @property integer numero
 * @property float potInstalada
 * @property integer baterias_id
 * @property integer proveedors_id
 */
class Grupos extends Model
{
    use SoftDeletes;

    public $table = 'grupos';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'numero',
        'potInstalada',
        'baterias_id',
        'proveedors_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'numero' => 'integer',
        'potInstalada' => 'float',
        'baterias_id' => 'integer',
        'proveedors_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'baterias_id' => 'required',
        'proveedors_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function baterias()
    {
        return $this->belongsTo(\App\Models\Bateria::class, 'baterias_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function proveedors()
    {
        return $this->belongsTo(\App\Models\Proveedor::class, 'proveedors_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function eventosDiarios()
    {
        return $this->hasMany(\App\Models\EventosDiario::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function generacions()
    {
        return $this->hasMany(\App\Models\Generacion::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function mantenimientos()
    {
        return $this->belongsToMany(\App\Models\Mantenimiento::class, 'grupos_mantenimientos','grupos_id','mantenimientos_id')
            ->withPivot('mantenimientos_id');
    }
}
