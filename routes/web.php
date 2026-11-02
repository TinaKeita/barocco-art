<?php

use Illuminate\Support\Facades\Route;
use App\Models\Image;

Route::get('/', function () {
    $images = Image::where('show_on_home', true)
        ->orderBy('sort_order')
        ->get();

    return view('home', compact('images'));
})->name('home');

Route::view('/pakalpojumi', 'services')->name('services');
Route::view('/kontakti', 'contacts')->name('contacts');

Route::get('/pakalpojumi/{slug}', function (string $slug) {
    return view('service', ['slug' => $slug]);
})->name('service');