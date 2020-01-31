<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Pailas
 * @package App\Models
 * @version May 29, 2019, 2:09 pm UTC
 *
 * @property \App\Models\Operador acompanante
 * @property \App\Models\CentralElectrica centralElectricas
 * @property \App\Models\Operador chofer
 * @property \App\Models\Operador operadors
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property string fecha
 * @property time hora
 * @property float combustibleFactura
 * @property float combustibleMedicion
 * @property string acciones
 * @property integer central_electricas_id
 * @property integer operadors_id
 * @property integer chofer_id
 * @property integer acompanante_id
 */
class Pailas extends Model
{
    use SoftDeletes;

    public $table = 'pailas';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'fecha',
        'hora',
        'combustibleFactura',
        'combustibleMedicion',
        'acciones',
        'causas',
        'central_electricas_id',
        'operadors_id',
        'chofer_id',
        'acompanante_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'fecha' => 'date:Y-m-d',
        'combustibleFactura' => 'float',
        'combustibleMedicion' => 'float',
        'acciones' => 'string',
        'causas' => 'string',
        'central_electricas_id' => 'integer',
        'operadors_id' => 'integer',
        'chofer_id' => 'integer',
        'acompanante_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'central_electricas_id' => 'required',
        'operadors_id' => 'required',
        'chofer_id' => 'required',
        'acompanante_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function acompanante()
    {
        return $this->belongsTo(\App\Models\Operador::class, 'acompanante_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function centralElectricas()
    {
        return $this->belongsTo(\App\Models\CentralElectrica::class, 'central_electricas_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function chofer()
    {
        return $this->belongsTo(\App\Models\Operador::class, 'chofer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function operadors()
    {
        return $this->belongsTo(\App\Models\Operador::class, 'operadors_id');
    }
}
