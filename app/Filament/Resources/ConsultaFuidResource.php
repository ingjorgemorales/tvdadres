<?php

namespace App\Filament\Resources;

use App\Models\ConsultaFuid;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\ConsultaFuidResource\Pages\ListConsultaFuids;
class ConsultaFuidResource extends HiddenResource
{
    protected static ?string $model = ConsultaFuid::class;
    public static function getPages(): array    {{        return [            'index' => ListConsultaFuids::route('/'),        ];    }}}
