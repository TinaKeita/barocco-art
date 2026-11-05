<?php

namespace App\Filament\Resources\HomePages\Pages;

use App\Filament\Resources\HomePages\HomePageResource;
use App\Models\HomePage;
use Filament\Resources\Pages\ListRecords;

class ListHomePages extends ListRecords
{
    protected static string $resource = HomePageResource::class;

    // There is only one home page, so skip the list and open it for editing
    public function mount(): void
    {
        $this->redirect(HomePageResource::getUrl('edit', ['record' => HomePage::current()]));
    }
}
