<?php

namespace App\Filament\Resources;

use App\Models\Matriztvd;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\MatriztvdResource\Pages\ListMatriztvds;
class MatriztvdResource extends HiddenResource
{
    protected static ?string $model = Matriztvd::class;
    public static function getPages(): array    {{        return [            'index' => ListMatriztvds::route('/'),        ];    }}}
