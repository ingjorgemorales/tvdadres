<?php

namespace App\Filament\Resources;

use App\Models\Subseccion;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\SubseccionResource\Pages\ListSubseccions;
class SubseccionResource extends HiddenResource
{
    protected static ?string $model = Subseccion::class;
    public static function getPages(): array    {{        return [            'index' => ListSubseccions::route('/'),        ];    }}}
