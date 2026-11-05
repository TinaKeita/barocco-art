<?php

namespace App\Filament\Resources\HomePages;

use App\Filament\Resources\HomePages\Pages\EditHomePage;
use App\Filament\Resources\HomePages\Pages\ListHomePages;
use App\Filament\Resources\HomePages\Schemas\HomePageForm;
use App\Models\HomePage;
use BackedEnum;
use Filament\Actions\EditAction;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class HomePageResource extends Resource
{
    protected static ?string $model = HomePage::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-home';

    protected static ?string $navigationLabel = 'Sākumlapa';

    protected static ?string $modelLabel = 'sākumlapa';

    protected static ?string $pluralModelLabel = 'Sākumlapa';

    protected static ?int $navigationSort = 0; // first in the menu

    // There is only one home page: no "create" and no "delete"
    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    // Clicking "Sākumlapa" in the menu opens the edit form straight away
    public static function getNavigationUrl(): string
    {
        return static::getUrl('edit', ['record' => HomePage::current()]);
    }

    public static function form(Schema $schema): Schema
    {
        return HomePageForm::configure($schema);
    }

    // Fallback list (normally you never see it – the menu goes straight to edit)
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('hero_title')->label('Virsraksts'),
                TextColumn::make('updated_at')->label('Mainīts')->dateTime('d.m.Y H:i'),
            ])
            ->recordActions([
                EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListHomePages::route('/'),
            'edit'  => EditHomePage::route('/{record}/edit'),
        ];
    }
}
