<?php

namespace App\Filament\Resources\Contacts\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ContactsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('initials')
                    ->label('')
                    ->badge(),

                TextColumn::make('name')
                    ->label('Vārds / adrese')
                    ->weight('bold')
                    ->searchable(),

                TextColumn::make('role')
                    ->label('Amats'),

                TextColumn::make('email')
                    ->label('E-pasts'),

                TextColumn::make('phone')
                    ->label('Telefons'),
            ])
            // Drag rows to change the order on the contacts page
            ->reorderable('sort_order')
            ->defaultSort('sort_order')
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
