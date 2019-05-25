<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CoberturaCombustible
 * @package App\Models
 * @version May 25, 2019, 3:18 am UTC
 *
 * @property \App\Models\CentralElectrica centralElectricas
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property float planReserva
 * @property float fondaje
 * @property float existOperativa
 * @property time coberturaHoras
 * @property float consumo
 * @property float suminCupet
 * @property float capacTotalAlmac
 * @property float capacVacio
 * @property float existTotalDiaAnterior
 * @property integer central_electricas_id
 */
class CoberturaCombustible extends Model
{
    use SoftDeletes;

    public $table = 'cobertura_combustibles';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'planReserva',
        'fondaje',
        'existOperativa',
        'coberturaHoras',
        'consumo',
        'suminCupet',
        'capacTotalAlmac',
        'capacVacio',
        'existTotalDiaAnterior',
        'central_electricas_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'planReserva' => 'float',
        'fondaje' => 'float',
        'existOperativa' => 'float',
        'consumo' => 'float',
        'suminCupet' => 'float',
        'capacTotalAlmac' => 'float',
        'capacVacio' => 'float',
        'existTotalDiaAnterior' => 'float',
        'central_electricas_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'central_electricas_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function centralElectricas()
    {
        return $this->belongsTo(\App\Models\CentralElectrica::class, 'central_electricas_id');
    }
}
