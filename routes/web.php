<?php

use App\Models\Image;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', function () {
    $images = Image::where('show_on_home', true)
        ->orderBy('sort_order')
        ->get();

    return view('home', compact('images'));
})->name('home');

// Services overview + contacts
Route::view('/pakalpojumi', 'services')->name('services');
Route::view('/kontakti', 'contacts')->name('contacts');

// Single service page
Route::get('/pakalpojumi/{slug}', function (string $slug) {

    $sections = [
        'celtnieciba' => [
            'id'    => 1,
            'label' => 'Celtniecība',
            'title' => 'Arhitektūra, projektēšana',
            'intro' => 'Pilns projektēšanas pakalpojumu serviss. Arhitektūras daļa, ģenplāna daļa, būvkonstrukcijas, inženiertehniskie tīkli. Autoruzraudzība.',
            'items' => [
                ['term' => 'Dzīvojamās ēkas', 'text' => 'daudzdzīvokļu nami, privātmājas.'],
                ['term' => 'Sabiedriskās ēkas', 'text' => 'ofisi, darījumu ēkas, tirdzniecības ēkas, ražošanas būves.'],
                ['term' => 'Apbūves priekšlikumi', 'text' => 'izstrādājam apbūves priekšlikumus saskaņā ar jūsu ieceri vai biznesa plānu. Izstrādājam koncepciju un pārskatāmu vizuālo informāciju. Sagatavojam tehnisko dokumentāciju iesniegšanai būvvaldē kā arī dokumentāciju bankas finansējuma saņemšanai.'],
                ['term' => 'Projektu saskaņošana', 'text' => 'skiču, tehnisko projektu saskaņošana Rīgas un Latvijas būvvaldēs.'],
            ],
        ],
        'projektesana' => [
            'id'    => 2,
            'label' => 'Projektēšana',
            'title' => 'Arhitektūra, projektēšana',
            'intro' => 'Pilns projektēšanas pakalpojumu serviss. Arhitektūras daļa, ģenplāna daļa, būvkonstrukcijas, inženiertehniskie tīkli. Autoruzraudzība.',
            'items' => [
                ['term' => 'Dzīvojamās ēkas', 'text' => 'daudzdzīvokļu nami, privātmājas.'],
                ['term' => 'Sabiedriskās ēkas', 'text' => 'ofisi, darījumu ēkas, tirdzniecības ēkas, ražošanas būves.'],
                ['term' => 'Apbūves priekšlikumi', 'text' => 'izstrādājam apbūves priekšlikumus saskaņā ar jūsu ieceri vai biznesa plānu. Izstrādājam koncepciju un pārskatāmu vizuālo informāciju. Sagatavojam tehnisko dokumentāciju iesniegšanai būvvaldē kā arī dokumentāciju bankas finansējuma saņemšanai.'],
                ['term' => 'Projektu saskaņošana', 'text' => 'skiču, tehnisko projektu saskaņošana Rīgas un Latvijas būvvaldēs.'],
            ],
        ],
        'interjera-dizains' => [
            'id'    => 3,
            'label' => 'Interjera dizains',
            'title' => 'Interjera projekti',
            'intro' => 'Izstrādājam pilnu interjera projektu saskaņā ar klienta vēlmēm. Projektiem nodrošinām autoruzraudzību.',
            'items' => [
                ['term' => 'Konsultācijas', 'text' => 'sniedzam profesionālas konsultācijas par jebkuru jautājumu, kas saistīts ar jūsu mājokļa vai darba vides iekārtošanu.'],
            ],
        ],
        'mebeles' => [
            'id'    => 4,
            'label' => 'Mēbeles',
            'title' => 'Mēbeles',
            'intro' => 'Pielāgoti mēbeļu risinājumi, kas iederas telpas arhitektūrā un akcentē materiālu kvalitāti.',
            'items' => [],
        ],
    ];

    abort_unless(isset($sections[$slug]), 404);

    $section = $sections[$slug];

    $images = Image::where('section_id', $section['id'])
        ->orderBy('sort_order')
        ->get();

    return view('service', compact('section', 'images'));
})->name('service');