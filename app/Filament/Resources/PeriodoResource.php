<?php

namespace App\Filament\Resources;

use App\Models\Periodo;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\PeriodoResource\Pages\ListPeriodos;
class PeriodoResource extends HiddenResource
{
    protected static ?string $model = Periodo::class;
    public static function getPages(): array    {{        return [            'index' => ListPeriodos::route('/'),        ];    }}}
