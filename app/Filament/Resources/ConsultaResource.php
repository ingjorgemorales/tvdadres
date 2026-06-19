<?php

namespace App\Filament\Resources;

use App\Models\Consulta;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\ConsultaResource\Pages\ListConsultas;
class ConsultaResource extends HiddenResource
{
    protected static ?string $model = Consulta::class;
    public static function getPages(): array    {{        return [            'index' => ListConsultas::route('/'),        ];    }}}
