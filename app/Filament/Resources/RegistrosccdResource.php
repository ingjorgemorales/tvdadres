<?php

namespace App\Filament\Resources;

use App\Models\Registrosccd;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\RegistrosccdResource\Pages\ListRegistrosccds;
class RegistrosccdResource extends HiddenResource
{
    protected static ?string $model = Registrosccd::class;
    public static function getPages(): array    {{        return [            'index' => ListRegistrosccds::route('/'),        ];    }}}
