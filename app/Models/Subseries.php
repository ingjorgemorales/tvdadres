<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Subseries
 *
 * @property $id
 * @property $codigo
 * @property $nombre
 * @property $id_serie
 * @property $created_at
 * @property $updated_at
 *
 * @property MatrizTvd[] $matrizTvds
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Subseries extends Model
{
    protected $table = 'subseries';
    protected $perPage = 500;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['codigo', 'nombre', 'id_serie'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function series()
    {
        return $this->belongsTo(\App\Models\Series::class, 'id_serie', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function matrizTvds()
    {
        return $this->hasMany(\App\Models\MatrizTvd::class, 'id_subserie', 'matriz_id_subserie');
    }
    
}
