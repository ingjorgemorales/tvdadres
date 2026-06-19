<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Matriztvd
 *
 * @property $id
 * @property $id_seccion
 * @property $id_subseccion
 * @property $id_serie
 * @property $id_subserie
 * @property $created_at
 * @property $updated_at
 *
 * @property Seccion $seccion
 * @property Series $series
 * @property Subseccion $subseccion
 * @property Subseries $subseries
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Matriztvd extends Model
{
    protected $table = 'matriztvd';
    protected $perPage = 1000;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['id_seccion', 'id_subseccion', 'id_serie', 'id_subserie'];


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
    public function series()
    {
        return $this->belongsTo(\App\Models\Series::class, 'id_serie', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subseccion()
    {
        return $this->belongsTo(\App\Models\Subseccion::class, 'id_subseccion', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subseries()
    {
        return $this->belongsTo(\App\Models\Subseries::class, 'id_subserie', 'id');
    }
    
}
