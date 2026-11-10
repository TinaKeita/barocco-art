<?php

use App\Models\Contact;
use App\Models\HomePage;
use App\Models\Image;
use App\Models\Section;
use Illuminate\Support\Facades\Route;

// Home – texts from the home_pages table, gallery from images marked "show on home"
Route::get('/', function () {
    $home = HomePage::current();

    $images = Image::with('section')
        ->where('show_on_home', true)
        ->orderBy('sort_order')
        ->get();

    return view('home', compact('home', 'images'));
})->name('home');

// Services overview – all sections with their images
Route::get('/pakalpojumi', function () {
    $sections = Section::with('images')
        ->orderBy('sort_order')
        ->get();

    return view('services', compact('sections'));
})->name('services');

// Single service page.
// {section} is looked up by slug automatically (see getRouteKeyName in Section).
// A slug that doesn't exist gives a 404 page.
Route::get('/pakalpojumi/{section}', function (Section $section) {
    $section->load('images');

    return view('service', compact('section'));
})->name('service');

// Contacts
Route::get('/kontakti', function () {
    $contacts = Contact::orderBy('sort_order')->get();

    return view('contacts', compact('contacts'));
})->name('contacts');
