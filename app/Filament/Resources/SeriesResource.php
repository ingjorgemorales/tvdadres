<?php

namespace App\Filament\Resources;

use App\Models\Series;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\SeriesResource\Pages\ListSeries;
class SeriesResource extends HiddenResource
{
    protected static ?string $model = Series::class;
    public static function getPages(): array    {{        return [            'index' => ListSeries::route('/'),        ];    }}}
