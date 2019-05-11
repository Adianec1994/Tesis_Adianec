<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Proveedor
 * @package App\Models
 * @version May 8, 2019, 6:15 am UTC
 *
 * @property \App\Models\Paiss paiss
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection grupos
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property string marca
 * @property string serie
 * @property integer paiss_id
 */
class Proveedor extends Model
{
    use SoftDeletes;

    public $table = 'proveedors';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'marca',
        'serie',
        'paiss_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'marca' => 'string',
        'serie' => 'string',
        'paiss_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'paiss_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function paiss()
    {
        return $this->belongsTo(\App\Models\Paiss::class, 'paiss_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function grupos()
    {
        return $this->hasMany(\App\Models\Grupo::class);
    }
}
