<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Planes
 * @package App\Models
 * @version May 24, 2019, 8:27 pm UTC
 *
 * @property \App\Models\Entidad entidads
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property string mes
 * @property float generacion
 * @property float indiceConsumoCombustible
 * @property float compromiso
 * @property integer entidads_id
 */
class Planes extends Model
{
    use SoftDeletes;

    public $table = 'plans';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'anno',
        'mes',
        'generacion',
        'indiceConsumoCombustible',
        'compromiso',
        'entidads_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'anno' => 'year',
        'mes' => 'string',
        'generacion' => 'float',
        'indiceConsumoCombustible' => 'float',
        'compromiso' => 'float',
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
}
