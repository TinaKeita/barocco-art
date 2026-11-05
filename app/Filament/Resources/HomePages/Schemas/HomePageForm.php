<?php

namespace App\Filament\Resources\HomePages\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class HomePageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                // ---------- Intro ----------
                Section::make('Ievads')
                    ->description('Lielais virsraksts un teksts lapas augšā.')
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('hero_title')
                            ->label('Virsraksts')
                            ->required()
                            ->maxLength(80),

                        Textarea::make('hero_text')
                            ->label('Teksts')
                            ->rows(4),
                    ]),

                // ---------- Gallery hint ----------
                Section::make('Galerija')
                    ->description('Sākumlapas bildes izvēlas sadaļā "Sadaļas": atver sadaļu un pie bildes ieķeksē "Rādīt sākumlapas galerijā".')
                    ->columnSpanFull(),

                // ---------- Services block ----------
                Section::make('Pakalpojumu bloks')
                    ->columnSpanFull()
                    ->columns(2)
                    ->schema([
                        TextInput::make('services_eyebrow')
                            ->label('Mazais virsraksts')
                            ->placeholder('Pakalpojumi')
                            ->maxLength(40),

                        TextInput::make('services_title')
                            ->label('Virsraksts')
                            ->maxLength(120),

                        Textarea::make('services_text')
                            ->label('Teksts')
                            ->rows(3)
                            ->columnSpanFull(),

                        Repeater::make('services_items')
                            ->label('Lodziņi')
                            ->schema([
                                TextInput::make('title')
                                    ->label('Virsraksts')
                                    ->required()
                                    ->maxLength(60),

                                Textarea::make('text')
                                    ->label('Teksts')
                                    ->required()
                                    ->rows(2),
                            ])
                            ->grid(2)
                            ->defaultItems(0)
                            ->reorderable()
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                            ->addActionLabel('Pievienot lodziņu')
                            ->columnSpanFull(),
                    ]),

                // ---------- Contact block ----------
                Section::make('Kontaktu bloks')
                    ->columnSpanFull()
                    ->columns(2)
                    ->schema([
                        TextInput::make('contact_eyebrow')
                            ->label('Mazais virsraksts')
                            ->placeholder('Kontakti')
                            ->maxLength(40),

                        TextInput::make('contact_title')
                            ->label('Virsraksts')
                            ->maxLength(120),

                        Textarea::make('contact_text')
                            ->label('Teksts')
                            ->rows(2)
                            ->columnSpanFull(),

                        TextInput::make('contact_email')
                            ->label('E-pasts pogai "E-pasts"')
                            ->email()
                            ->maxLength(120),

                        TextInput::make('contact_phone')
                            ->label('Telefons pogai "Zvanīt"')
                            ->tel()
                            ->maxLength(30),
                    ]),
            ]);
    }
}
