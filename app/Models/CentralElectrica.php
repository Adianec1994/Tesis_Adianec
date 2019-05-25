<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CentralElectrica
 * @package App\Models
 * @version May 25, 2019, 1:08 am UTC
 *
 * @property \App\Models\Entidad entidads
 * @property \Illuminate\Database\Eloquent\Collection baterias
 * @property \Illuminate\Database\Eloquent\Collection coberturaCombustibles
 * @property \Illuminate\Database\Eloquent\Collection datosGenerales
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection pailas
 * @property string nombre
 * @property float potInstalada
 * @property integer entidads_id
 */
class CentralElectrica extends Model
{
    use SoftDeletes;

    public $table = 'central_electricas';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nombre',
        'potInstalada',
        'entidads_id'
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
        'entidads_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
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
    public function baterias()
    {
        return $this->hasMany(\App\Models\Bateria::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function coberturaCombustibles()
    {
        return $this->hasMany(\App\Models\CoberturaCombustible::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function datosGenerales()
    {
        return $this->hasMany(\App\Models\DatosGenerale::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function pailas()
    {
        return $this->hasMany(\App\Models\Paila::class);
    }
}
