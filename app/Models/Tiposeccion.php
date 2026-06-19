<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tiposeccion
 *
 * @property $id
 * @property $nombre
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Tiposeccion extends Model
{
    protected $table = 'tiposeccion';
    protected $perPage = 100;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['nombre'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seccion()
    {
        return $this->belongsTo(\App\Models\Seccion::class, 'id_tipo', 'id');
    }
}
