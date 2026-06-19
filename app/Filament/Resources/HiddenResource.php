<?php

namespace App\Filament\Resources;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

abstract class HiddenResource extends Resource
{
    protected static bool $shouldRegisterNavigation = false;
    protected static BackedEnum|string|null $navigationIcon = null;
    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return $schema;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID'),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }
}
