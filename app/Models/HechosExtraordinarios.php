<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class HechosExtraordinarios
 * @package App\Models
 * @version May 24, 2019, 5:44 pm UTC
 *
 * @property \App\Models\Entidad entidads
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property string tipo
 * @property string fecha
 * @property time hora
 * @property string descripcion
 * @property string medidas
 * @property string nombreImplicado
 * @property string nombreInforma
 * @property integer entidads_id
 */
class HechosExtraordinarios extends Model
{
    use SoftDeletes;

    public $table = 'hechos_extraordinarios';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'tipo',
        'fecha',
        'hora',
        'descripcion',
        'medidas',
        'nombreImplicado',
        'nombreInforma',
        'entidads_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'tipo' => 'string',
        'fecha' => 'date',
        'descripcion' => 'string',
        'medidas' => 'string',
        'nombreImplicado' => 'string',
        'nombreInforma' => 'string',
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
