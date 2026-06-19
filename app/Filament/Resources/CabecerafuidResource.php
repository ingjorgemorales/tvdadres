<?php

namespace App\Filament\Resources;

use App\Models\Cabecerafuid;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\CabecerafuidResource\Pages\ListCabecerafuids;
class CabecerafuidResource extends HiddenResource
{
    protected static ?string $model = Cabecerafuid::class;
    public static function getPages(): array    {{        return [            'index' => ListCabecerafuids::route('/'),        ];    }}}
