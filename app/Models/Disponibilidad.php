<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Disponibilidad
 * @package App\Models
 * @version May 22, 2019, 3:58 am UTC
 *
 * @property \App\Models\Entidad entidads
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property string fecha
 * @property float potInstaladaReal
 * @property float potDisponibleReal
 * @property integer entidads_id
 */
class Disponibilidad extends Model
{
    use SoftDeletes;

    public $table = 'disponibilidads';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'fecha',
        'potInstaladaReal',
        'potDisponibleReal',
        'entidads_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'fecha' => 'date',
        'potInstaladaReal' => 'float',
        'potDisponibleReal' => 'float',
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
