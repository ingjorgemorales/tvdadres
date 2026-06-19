<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $table = 'registrosfuid';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['id_cabecerafuid', 'orden', 'id_serie', 'id_subserie', 'unidad_documental', 'fecha_inicial', 'fecha_final', 'soporte_fisico', 'soporte_electronico', 'caja', 'carpeta', 'tomolegajolibro', 'folios', 'codigibarrascaja', 'codigibarrascarpeta', 'signatura_topografica', 'otro_tipo', 'otro_cantidad', 'electronico_ubicacion', 'electronico_cantidad', 'electronico_tamano', 'notas'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cabecerafuid()
    {
        return $this->belongsTo(Cabecerafuid::class, 'id_cabecerafuid', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function periodo()
    {
        return $this->belongsTo(Periodo::class, 'id_periodo', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seccion()
    {
        return $this->belongsTo(Seccion::class, 'id_seccion', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subseccion()
    {
        return $this->belongsTo(Subseccion::class, 'id_subseccion', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function series()
    {
        return $this->belongsTo(Series::class, 'id_serie', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subseries()
    {
        return $this->belongsTo(Subseries::class, 'id_subserie', 'id');
    }

}
