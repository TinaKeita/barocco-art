<?php

namespace App\Filament\Resources\Sections\Schemas;

use App\Filament\Forms\Components\ImageUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                // ---------- Basic info ----------
                Section::make('Pamatinformācija')
                    ->columnSpanFull()
                    ->columns(2)
                    ->schema([
                        TextInput::make('label')
                            ->label('Nosaukums izvēlnē')
                            ->helperText('Piem. "Celtniecība". Rādās izvēlnē un kā mazais virsraksts.')
                            ->required()
                            ->maxLength(60),

                        TextInput::make('slug')
                            ->label('Adrese (URL)')
                            ->helperText('Tikai mazie burti, cipari un domuzīmes, piem. "projektu-vadiba".')
                            ->prefix('/pakalpojumi/')
                            ->required()
                            ->alphaDash()
                            ->unique(ignoreRecord: true)
                            ->maxLength(80),

                        TextInput::make('title')
                            ->label('Virsraksts')
                            ->required()
                            ->maxLength(120)
                            ->columnSpanFull(),

                        Textarea::make('intro')
                            ->label('Ievadteksts')
                            ->helperText('Rādās pakalpojumu sarakstā un sadaļas lapas sākumā.')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),

                // ---------- Bold "term – text" lines ----------
                Section::make('Punkti')
                    ->description('Treknraksta punkti, piem. "Dzīvojamās ēkas – daudzdzīvokļu nami, privātmājas."')
                    ->columnSpanFull()
                    ->collapsible()
                    ->schema([
                        Repeater::make('items')
                            ->hiddenLabel()
                            ->schema([
                                TextInput::make('term')
                                    ->label('Treknrakstā')
                                    ->required()
                                    ->maxLength(80),

                                Textarea::make('text')
                                    ->label('Teksts')
                                    ->required()
                                    ->rows(2),
                            ])
                            ->columns(1)
                            ->defaultItems(0)
                            ->reorderable()
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['term'] ?? null)
                            ->addActionLabel('Pievienot punktu'),
                    ]),

                // ---------- Images ----------
                Section::make('Bildes')
                    ->description('Pirmā bilde ir galvenā (blakus tekstam un pakalpojumu sarakstā), pārējās ir galerijā. Velc, lai mainītu secību.')
                    ->columnSpanFull()
                    ->schema([
                        Repeater::make('images')
                            ->hiddenLabel()
                            ->relationship()                 // saves to the images table
                            ->orderColumn('sort_order')      // drag to reorder
                            ->schema([
                                // on the site every image is 4:3, so the editor shows a 4:3 frame
                                ImageUpload::make('path')
                                    ->label('Bilde')
                                    ->helperText('Pēc augšupielādes velc bildi rāmī, ar peles ritenīti tuvini, ar bultām pagriez. Zīmulītis atver to vēlreiz.')
                                    ->image()
                                    ->imageEditor()
                                    ->imageAspectRatio('4:3')
                                    ->automaticallyOpenImageEditorForAspectRatio()
                                    ->disk('public')
                                    ->directory('sections')
                                    ->visibility('public')
                                    ->maxSize(5120)          // 5 MB
                                    ->required(),

                                TextInput::make('alt_text')
                                    ->label('Apraksts')
                                    ->helperText('Īss bildes apraksts (redzams meklētājiem un ekrāna lasītājiem).')
                                    ->maxLength(150),

                                Toggle::make('show_on_home')
                                    ->label('Rādīt sākumlapas galerijā'),
                            ])
                            ->grid(2)
                            ->defaultItems(0)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['alt_text'] ?? null)
                            ->addActionLabel('Pievienot bildi'),
                    ]),
            ]);
    }
}
