<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Periodo
 *
 * @property $id
 * @property $nombre
 * @property $fecha_inicial
 * @property $fecha_final
 * @property $created_at
 * @property $updated_at
 *
 * @property Cabeceraccd[] $cabeceraccds
 * @property Cabecerafuid[] $cabecerafuids
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Periodo extends Model
{
    
    protected $perPage = 50;
    protected $table = 'periodos';
    protected $dateFormat = "Y-m-d";

    protected $casts = [
        'fecha_inicial' => 'datetime',
        'fecha_final' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['nombre', 'fecha_inicial', 'fecha_final'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cabeceraccds()
    {
        return $this->hasMany(\App\Models\Cabeceraccd::class, 'id_periodo', 'ccd_id_periodo');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cabecerafuids()
    {
        return $this->hasMany(\App\Models\Cabecerafuid::class, 'id_periodo', 'fuid_id_periodo');
    }
    
}
