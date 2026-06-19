<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsultaFuid extends Model
{
    protected $table = 'cabecerafuid';

    protected $fillable = ['proceso', 'formato', 'codigo', 'version', 'fecha', 'entidad_remitente', 'entidad_productora', 'objeto', 'id_seccion', 'id_subseccion', 'id_periodo'];

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
    public function serie()
    {
        return $this->belongsTo(Series::class, 'id_serie', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subserie()
    {
        return $this->belongsTo(Subseries::class, 'id_subserie', 'id');
    }
}
