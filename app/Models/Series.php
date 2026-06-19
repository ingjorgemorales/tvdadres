<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Series
 *
 * @property $id
 * @property $codigo
 * @property $nombre
 * @property $created_at
 * @property $updated_at
 *
 * @property MatrizTvd[] $matrizTvds
 * @property Subseries[] $subseries
 * @property Registrosfuid[] $registrosfuids

 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Series extends Model
{
    protected $table = 'series';
    protected $perPage = 500;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['codigo', 'nombre'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    /*public function matrizTvds()
    {
        return $this->hasMany(\App\Models\MatrizTvd::class, 'id_serie', 'matriz_id_serie');
    }*/
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    /*public function registrosfuids()
    {
        return $this->hasMany(\App\Models\Registrosfuid::class, 'id_serie', 'fuid_id_serie');
    }*/

    public function subseriesById()
    {
        return $this->hasMany(\App\Models\Subseries::class, 'id_serie', 'id');
    }
    
}
