<?php

namespace App\Providers;

use App\Models\Section;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    // not used yet
    public function register(): void
    {
    }

    public function boot(): void
    {
        // nav is on every page so it gets the sections here
        View::composer('partials.nav', function ($view) {
            $view->with('navSections', Section::orderBy('sort_order')->get(['slug', 'label']));
        });
    }
}
