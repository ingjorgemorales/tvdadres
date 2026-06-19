<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Subseccion
 *
 * @property $id
 * @property $id_seccion
 * @property $codigo
 * @property $nombre
 * @property $id_tipo
 * @property $created_at
 * @property $updated_at
 *
 * @property Seccion $seccion
 * @property tiposeccion[] $tiposeccion
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Subseccion extends Model
{
    protected $table = 'subseccion';
    protected $perPage = 100;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['id_seccion', 'codigo', 'nombre', 'id_tipo'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seccion()
    {
        return $this->belongsTo(\App\Models\Seccion::class, 'id_seccion', 'id');
    }
    
      /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tiposeccion()
    {
        return $this->belongsTo(\App\Models\tiposeccion::class, 'id_tipo', 'id');
    }
}
