<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    public function run(): void
    {
        // first two sections have the same text so i saved it once
        $architectureItems = [
            ['term' => 'Dzīvojamās ēkas', 'text' => 'daudzdzīvokļu nami, privātmājas.'],
            ['term' => 'Sabiedriskās ēkas', 'text' => 'ofisi, darījumu ēkas, tirdzniecības ēkas, ražošanas būves.'],
            ['term' => 'Apbūves priekšlikumi', 'text' => 'izstrādājam apbūves priekšlikumus saskaņā ar jūsu ieceri vai biznesa plānu. Izstrādājam koncepciju un pārskatāmu vizuālo informāciju. Sagatavojam tehnisko dokumentāciju iesniegšanai būvvaldē kā arī dokumentāciju bankas finansējuma saņemšanai.'],
            ['term' => 'Projektu saskaņošana', 'text' => 'skiču, tehnisko projektu saskaņošana Rīgas un Latvijas būvvaldēs.'],
        ];

        // all services, slug is used in the url
        $sections = [
            [
                'slug'  => 'celtnieciba',
                'label' => 'Celtniecība',
                'title' => 'Arhitektūra, projektēšana',
                'intro' => 'Pilns projektēšanas pakalpojumu serviss. Arhitektūras daļa, ģenplāna daļa, būvkonstrukcijas, inženiertehniskie tīkli. Autoruzraudzība.',
                'items' => $architectureItems,
            ],
            [
                'slug'  => 'projektesana',
                'label' => 'Projektēšana',
                'title' => 'Arhitektūra, projektēšana',
                'intro' => 'Pilns projektēšanas pakalpojumu serviss. Arhitektūras daļa, ģenplāna daļa, būvkonstrukcijas, inženiertehniskie tīkli. Autoruzraudzība.',
                'items' => $architectureItems,
            ],
            [
                'slug'  => 'interjera-dizains',
                'label' => 'Interjera dizains',
                'title' => 'Interjera projekti',
                'intro' => 'Izstrādājam pilnu interjera projektu saskaņā ar klienta vēlmēm. Projektiem nodrošinām autoruzraudzību.',
                'items' => [
                    ['term' => 'Konsultācijas', 'text' => 'sniedzam profesionālas konsultācijas par jebkuru jautājumu, kas saistīts ar jūsu mājokļa vai darba vides iekārtošanu.'],
                ],
            ],
            [
                'slug'  => 'projektu-vadiba',
                'label' => 'Projektu vadība',
                'title' => 'Projektu vadība',
                'intro' => 'Izstrāde procesā.',
                'items' => [],
            ],
        ];

        foreach ($sections as $i => $data) {
            // updateOrCreate so there are no duplicates
            Section::updateOrCreate(
                ['slug' => $data['slug']],
                $data + ['sort_order' => $i]
            );
        }
    }
}