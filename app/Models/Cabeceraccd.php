<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Cabeceraccd
 *
 * @property $id
 * @property $proceso
 * @property $formato
 * @property $codigo
 * @property $version
 * @property $fecha
 * @property $entidad_productora
 * @property $oficina
 * @property $id_periodo
 * @property $created_at
 * @property $updated_at
 *
 * @property Periodo $periodo
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Cabeceraccd extends Model
{
    protected $table = 'cabeceraccd';
    protected $perPage = 100;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['proceso', 'formato', 'codigo', 'version', 'fecha', 'entidad_productora', 'oficina', 'id_periodo'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function periodo()
    {
        return $this->belongsTo(\App\Models\Periodo::class, 'id_periodo', 'id');
    }
    
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
        //return $this->belongsTo(\App\Models\Subseccion::class, 'id_subseccion', 'id');
        return $this->belongsTo(\App\Models\Subseccion::class, 'oficina', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subseries()
    {
        return $this->belongsTo(\App\Models\Subseries::class, 'id_subserie', 'id');
    }
    
}
