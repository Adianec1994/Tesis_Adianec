<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Baterias
 * @package App\Models
 * @version May 25, 2019, 2:42 am UTC
 *
 * @property \App\Models\CentralElectrica centralElectricas
 * @property \Illuminate\Database\Eloquent\Collection grupos
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property integer numero
 * @property float potInstalada
 * @property integer central_electricas_id
 */
class Baterias extends Model
{
    use SoftDeletes;

    public $table = 'baterias';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'numero',
        'potInstalada',
        'central_electricas_id'
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function grupos()
    {
        return $this->hasMany(\App\Models\Grupo::class);
    }
}
