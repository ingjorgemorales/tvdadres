<?php

namespace App\Filament\Resources;

use App\Models\Seccion;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\SeccionResource\Pages\ListSeccions;
class SeccionResource extends HiddenResource
{
    protected static ?string $model = Seccion::class;
    public static function getPages(): array    {{        return [            'index' => ListSeccions::route('/'),        ];    }}}
