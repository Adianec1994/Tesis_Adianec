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
        'brigadas_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'fechaMtto' => 'date',
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
        'mantenedores_externos_id' => 'required',
        'brigadas_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    /*public function grupos()
    {
        return $this->belongsTo(\App\Models\Grupo::class, 'grupos_id');
    }*/
    public function mantenedores_externos()
    {
        return $this->belongsTo(\App\Models\MantenedorExterno::class, 'mantenedores_externos_id');
    }

    public function brigadas()
    {
        return $this->belongsTo(\App\Models\Brigada::class, 'brigadas_id');
    }
}
