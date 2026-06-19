<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Seccion
 *
 * @property $id
 * @property $codigo
 * @property $nombre
 * @property $id_tipo
 * @property $created_at
 * @property $updated_at
 *
 * @property Subseccion[] $subseccion
 * @property tiposeccion[] $tiposeccion
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Seccion extends Model
{
    protected $table = 'seccion';
    protected $perPage = 100;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['codigo', 'nombre', 'id_tipo'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subseccion()
    {
        return $this->hasMany(\App\Models\Subseccion::class, 'id', 'id_seccion');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tiposeccion()
    {
        return $this->belongsTo(\App\Models\tiposeccion::class, 'id_tipo', 'id');
    }
    
    public function subseccionesbyid()
    {
        return $this->hasMany(\App\Models\Subseccion::class, 'id_seccion', 'id');
    }
}
