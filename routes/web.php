<?php

use App\Models\Contact;
use App\Models\Image;
use App\Models\Section;
use Illuminate\Support\Facades\Route;

// home page, shows only images with show_on_home
Route::get('/', function () {
    $images = Image::where('show_on_home', true)
        ->orderBy('sort_order')
        ->get();

    return view('home', compact('images'));
})->name('home');

// list of all services
Route::get('/pakalpojumi', function () {
    $sections = Section::with('images')
        ->orderBy('sort_order')
        ->get();

    return view('services', compact('sections'));
})->name('services');

// one service page, laravel finds the section by slug (wrong slug = 404)
Route::get('/pakalpojumi/{section}', function (Section $section) {
    $section->load('images');

    return view('service', compact('section'));
})->name('service');

// contacts page
Route::get('/kontakti', function () {
    $contacts = Contact::orderBy('sort_order')->get();

    return view('contacts', compact('contacts'));
})->name('contacts');
