<?php

namespace App\Filament\Resources;

use App\Models\Cabeceraccd;
use App\Filament\Resources\CabeceraccdResource\Pages\ListCabeceraccds;
class CabeceraccdResource extends HiddenResource
{
    protected static ?string $model = Cabeceraccd::class;
    public static function getPages(): array    {{        return [            'index' => ListCabeceraccds::route('/'),        ];    }}
}
