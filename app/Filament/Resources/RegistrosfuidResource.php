<?php

namespace App\Filament\Resources;

use App\Models\Registrosfuid;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\RegistrosfuidResource\Pages\ListRegistrosfuids;
class RegistrosfuidResource extends HiddenResource
{
    protected static ?string $model = Registrosfuid::class;
    public static function getPages(): array    {{        return [            'index' => ListRegistrosfuids::route('/'),        ];    }}}
