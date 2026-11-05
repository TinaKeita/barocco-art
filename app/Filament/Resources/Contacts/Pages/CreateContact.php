<?php

namespace App\Filament\Resources\Contacts\Pages;

use App\Filament\Resources\Contacts\ContactResource;
use Filament\Resources\Pages\CreateRecord;

class CreateContact extends CreateRecord
{
    protected static string $resource = ContactResource::class;

    // After saving, go back to the list instead of staying on the form
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
