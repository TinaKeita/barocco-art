<?php

namespace App\Filament\Resources\Contacts\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContactForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Kontakts')
                    ->columnSpanFull()
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Vārds vai adrese')
                            ->helperText('Piem. "Armands Lūsis" vai "Brīvības iela 137 Rīga, Latvija".')
                            ->required()
                            ->maxLength(120),

                        TextInput::make('role')
                            ->label('Amats / nodaļa')
                            ->helperText('Piem. "Arhitektūra, projektēšana" vai "Birojs".')
                            ->required()
                            ->maxLength(80),

                        TextInput::make('initials')
                            ->label('Iniciāļi')
                            ->helperText('2 burti krāsainajā aplī, piem. "AL".')
                            ->required()
                            ->maxLength(3),

                        TextInput::make('email')
                            ->label('E-pasts')
                            ->email()
                            ->maxLength(120),

                        TextInput::make('phone')
                            ->label('Telefons')
                            ->tel()
                            ->placeholder('+371 2 000 0000')
                            ->maxLength(30),

                        TextInput::make('phone_note')
                            ->label('Piezīme pie telefona')
                            ->placeholder('gsm / WhatsApp')
                            ->maxLength(30),
                    ]),
            ]);
    }
}
