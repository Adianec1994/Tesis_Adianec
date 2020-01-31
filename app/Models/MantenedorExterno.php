<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class MantenedorExterno
 * @package App\Models
 * @version May 30, 2019, 2:53 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection mantenimientos
 * @property string nombre
 * @property integer numeroContrato
 * @property string fechaInicio
 * @property string fechaFin
 */
class MantenedorExterno extends Model
{
    use SoftDeletes;

    public $table = 'mantenedores_externos';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nombre',
        'numeroContrato',
        'fechaInicio',
        'fechaFin'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string',
        'numeroContrato' => 'integer',
        'fechaInicio' => 'date:Y-m-d',
        'fechaFin' => 'date:Y-m-d'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function mantenimientos()
    {
        return $this->hasMany(\App\Models\Mantenimiento::class);
    }
}
