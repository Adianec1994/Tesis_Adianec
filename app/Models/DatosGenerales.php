<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DatosGenerales
 * @package App\Models
 * @version May 26, 2019, 4:25 am UTC
 *
 * @property \App\Models\CentralElectrica centralElectricas
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property float genBruta
 * @property float insumos
 * @property float recibido
 * @property float volumenRecibido
 * @property float consumoGeneracion
 * @property float densidadPonderada
 * @property float temperatura
 * @property float densidadCorreccion
 * @property float valorCalorico
 * @property float existencia
 * @property float cobertura
 * @property float indiceConsumo
 * @property float lubricteRecibido
 * @property float lubricteCsmoReposicion
 * @property float lubricteCsmoCambio
 * @property float lubricteCsmoTotal
 * @property float lubricteExistencia
 * @property float lubricteCobertura
 * @property float lubricteIndiceCsmo
 * @property float refrigteRecibido
 * @property float refrigteConsumo
 * @property float refrigteExistencia
 * @property integer central_electricas_id
 */
class DatosGenerales extends Model
{
    use SoftDeletes;

    public $table = 'datos_generales';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'genBruta',
        'insumos',
        'recibido',
        'volumenRecibido',
        'consumoGeneracion',
        'densidadPonderada',
        'temperatura',
        'densidadCorreccion',
        'valorCalorico',
        'existencia',
        'cobertura',
        'indiceConsumo',
        'lubricteRecibido',
        'lubricteCsmoReposicion',
        'lubricteCsmoCambio',
        'lubricteCsmoTotal',
        'lubricteExistencia',
        'lubricteCobertura',
        'lubricteIndiceCsmo',
        'refrigteRecibido',
        'refrigteConsumo',
        'refrigteExistencia',
        'central_electricas_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'genBruta' => 'float',
        'insumos' => 'float',
        'recibido' => 'float',
        'volumenRecibido' => 'float',
        'consumoGeneracion' => 'float',
        'densidadPonderada' => 'float',
        'temperatura' => 'float',
        'densidadCorreccion' => 'float',
        'valorCalorico' => 'float',
        'existencia' => 'float',
        'cobertura' => 'float',
        'indiceConsumo' => 'float',
        'lubricteRecibido' => 'float',
        'lubricteCsmoReposicion' => 'float',
        'lubricteCsmoCambio' => 'float',
        'lubricteCsmoTotal' => 'float',
        'lubricteExistencia' => 'float',
        'lubricteCobertura' => 'float',
        'lubricteIndiceCsmo' => 'float',
        'refrigteRecibido' => 'float',
        'refrigteConsumo' => 'float',
        'refrigteExistencia' => 'float',
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
