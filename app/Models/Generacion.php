<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Generacion
 * @package App\Models
 * @version June 4, 2019, 2:21 am UTC
 *
 * @property \App\Models\Grupo grupos
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property string fecha
 * @property time horaEntrada
 * @property time horaSalida
 * @property string reportadoPor
 * @property time tiempoOperacion
 * @property integer grupos_id
 */
class Generacion extends Model
{
    use SoftDeletes;

    public $table = 'generacions';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'fecha',
        'horaEntrada',
        'horaSalida',
        'reportadoPor',
        'tiempoOperacion',
        'grupos_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'fecha' => 'date',
        'reportadoPor' => 'string',
        'grupos_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'grupos_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function grupos()
    {
        return $this->belongsTo(\App\Models\Grupo::class, 'grupos_id');
    }
}
