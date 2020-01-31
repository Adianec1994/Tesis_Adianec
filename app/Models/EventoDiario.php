<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class EventoDiario
 * @package App\Models
 * @version May 30, 2019, 12:38 am UTC
 *
 * @property \App\Models\Grupo grupos
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property string estado
 * @property string|\Carbon\Carbon fechaEvento
 * @property string|\Carbon\Carbon fechaPosibleSolucion
 * @property string|\Carbon\Carbon fechaReporte
 * @property string|\Carbon\Carbon fechaDiagnostico
 * @property string|\Carbon\Carbon fechaSolucion
 * @property integer horas
 * @property string sistema
 * @property string subSistema
 * @property string parte
 * @property string fallo
 * @property string diagnosticoPreliminar
 * @property string diagnostico
 * @property string responsable
 * @property string insertadoPor
 * @property integer grupos_id
 */
class EventoDiario extends Model
{
    use SoftDeletes;

    public $table = 'eventos_diarios';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'estado',
        'fechaEvento',
        'fechaPosibleSolucion',
        'fechaReporte',
        'fechaDiagnostico',
        'fechaSolucion',
        'horas',
        'sistema',
        'subSistema',
        'parte',
        'fallo',
        'diagnosticoPreliminar',
        'diagnostico',
        'responsable',
        'insertadoPor',
        'grupos_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'estado' => 'string',
        'fechaEvento' => 'datetime:Y-m-d',
        'fechaPosibleSolucion' => 'datetime:Y-m-d',
        'fechaReporte' => 'datetime:Y-m-d',
        'fechaDiagnostico' => 'datetime:Y-m-d',
        'fechaSolucion' => 'datetime:Y-m-d',
        'horas' => 'integer',
        'sistema' => 'string',
        'subSistema' => 'string',
        'parte' => 'string',
        'fallo' => 'string',
        'diagnosticoPreliminar' => 'string',
        'diagnostico' => 'string',
        'responsable' => 'string',
        'insertadoPor' => 'string',
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
