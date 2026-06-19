<?php

namespace App\Filament\Resources;

use App\Models\Tiposeccion;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\TiposeccionResource\Pages\ListTiposeccion;
class TiposeccionResource extends HiddenResource
{
    protected static ?string $model = Tiposeccion::class;
    public static function getPages(): array    {{        return [            'index' => ListTiposeccion::route('/'),        ];    }}}
