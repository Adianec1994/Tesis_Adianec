<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mantenimiento extends Model
{
    use SoftDeletes;

    public $table = 'mantenimientos';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'fechaMtto',
        'tipoTrabajo',
        'horaEntrada',
        'horaSalida',
        'informa',
        'resultado',
        'mantenedores_externos_id',
        'brigadas_id',
        'grupos_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'grupos_id' => 'integer',
        'fechaMtto' => 'date',
        'horaEntrada' => 'time',
        'horaSalida' => 'time',
        'tipoTrabajo' => 'string',
        'informa' => 'string',
        'resultado' => 'string',
        'mantenedores_externos_id' => 'integer',
        'brigadas_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'grupos_id' => 'required',

    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/

    public function mantenedores_externos()
    {
        return $this->belongsTo(\App\Models\MantenedorExterno::class, 'mantenedores_externos_id');
    }

    public function brigadas()
    {
        return $this->belongsTo(\App\Models\Brigada::class, 'brigadas_id');
    }

    public function grupos()
    {
        return $this->belongsToMany(\App\Models\Grupos::class, 'grupos_mantenimientos',
            'mantenimientos_id','grupos_id')->withPivot('grupos_id');
    }
}
