<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Registrosfuid
 *
 * @property $id
 * @property $id_cabecerafuid
 * @property $orden
 * @property $id_serie
 * @property $id_subserie
 * @property $unidad_documental
 * @property $fecha_inicial
 * @property $fecha_final
 * @property $soporte_fisico
 * @property $soporte_electronico
 * @property $caja
 * @property $carpeta
 * @property $tomolegajolibro
 * @property $folios
 * @property $codigibarrascaja
 * @property $codigibarrascarpeta
 * @property $signatura_topografica
 * @property $otro_tipo
 * @property $otro_cantidad
 * @property $electronico_ubicacion
 * @property $electronico_cantidad
 * @property $electronico_tamano
 * @property $notas
 * @property $created_at
 * @property $updated_at
 *
 * @property Cabecerafuid $cabecerafuid
 * @property Series $series
 * @property Subseries $subseries
 * @property Seccion $seccion
 * @property Subseccion $subseccion
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Registrosfuid extends Model
{
    protected $table = 'registrosfuid';
    protected $perPage = 20;
    protected $primaryKey = 'id';
    protected $keyType = 'int';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['id', 'id_cabecerafuid', 'orden', 'id_serie', 'id_subserie', 'unidad_documental', 'fecha_inicial', 'fecha_final', 'soporte_fisico', 'soporte_electronico', 'caja', 'carpeta', 'tomolegajolibro', 'folios', 'codigibarrascaja', 'codigibarrascarpeta', 'signatura_topografica', 'otro_tipo', 'otro_cantidad', 'electronico_ubicacion', 'electronico_cantidad', 'electronico_tamano', 'notas'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cabecerafuid()
    {
        return $this->belongsTo(\App\Models\Cabecerafuid::class, 'id_cabecerafuid', 'id');
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
    
}
