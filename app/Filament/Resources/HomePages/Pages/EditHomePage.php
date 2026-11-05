<?php

namespace App\Filament\Resources\HomePages\Pages;

use App\Filament\Resources\HomePages\HomePageResource;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditHomePage extends EditRecord
{
    protected static string $resource = HomePageResource::class;

    public function getTitle(): string | Htmlable
    {
        return 'Sākumlapa';
    }

    // No delete button – the home page must always exist
    protected function getHeaderActions(): array
    {
        return [];
    }
}
