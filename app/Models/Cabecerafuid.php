<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Cabecerafuid
 *
 * @property $id
 * @property $proceso
 * @property $formato
 * @property $codigo
 * @property $version
 * @property $fecha
 * @property $entidad_remitente
 * @property $entidad_productora
 * @property $objeto
 * @property $id_seccion
 * @property $id_subseccion
 * @property $id_periodo
 * @property $created_at
 * @property $updated_at
 *
 * @property Periodo $periodo
 * @property Seccion $seccion
 * @property Subseccion $subseccion
 * @property Registrosfuid[] $registrosfuids

 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Cabecerafuid extends Model
{
    protected $table = 'cabecerafuid';
    protected $perPage = 100;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['proceso', 'formato', 'codigo', 'version', 'fecha', 'entidad_remitente', 'entidad_productora', 'objeto', 'id_seccion', 'id_subseccion', 'id_periodo'];


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
    public function subseccion()
    {
        return $this->belongsTo(\App\Models\Subseccion::class, 'id_subseccion', 'id');
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
    public function subseries()
    {
        return $this->belongsTo(\App\Models\Subseries::class, 'id_subserie', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    /*public function registrosfuids()
    {
        return $this->hasMany(\App\Models\Registrosfuid::class, 'id_cabecerafuid', 'id');
    }*/
    
    
}
