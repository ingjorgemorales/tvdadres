<?php

namespace App\Filament\Resources;

use App\Models\Subseries;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\SubseriesResource\Pages\ListSubseries;
class SubseriesResource extends HiddenResource
{
    protected static ?string $model = Subseries::class;
    public static function getPages(): array    {{        return [            'index' => ListSubseries::route('/'),        ];    }}}
