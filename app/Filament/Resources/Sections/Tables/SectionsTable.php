<?php

namespace App\Filament\Resources\Sections\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SectionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('label')
                    ->label('Nosaukums')
                    ->weight('bold')
                    ->searchable(),

                TextColumn::make('title')
                    ->label('Virsraksts')
                    ->limit(40),

                TextColumn::make('slug')
                    ->label('Adrese')
                    ->prefix('/pakalpojumi/')
                    ->color('gray'),

                TextColumn::make('images_count')
                    ->label('Bildes')
                    ->counts('images')
                    ->badge(),
            ])
            // Drag rows to change the order in the menu and on the services page
            ->reorderable('sort_order')
            ->defaultSort('sort_order')
            ->recordActions([
                EditAction::make(),
            ]);
    }
}
