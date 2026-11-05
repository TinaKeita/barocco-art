<?php

namespace Database\Seeders;

use App\Models\HomePage;
use Illuminate\Database\Seeder;

class HomePageSeeder extends Seeder
{
    public function run(): void
    {
        HomePage::updateOrCreate(['id' => 1], [
            'hero_title' => 'Barocco Art',
            'hero_text'  => 'Mūsdienīga arhitektūra, tīras līnijas un telpas, kas atdzīvojas gaismā. Barocco Art kolekcijā apvienojam privātmājas, industriālos risinājumus un radošus interjerus, lai radītu vietas, kas iedvesmo ikvienu apmeklētāju.',

            'services_eyebrow' => 'Pakalpojumi',
            'services_title'   => 'Telpas, kas strādā jūsu idejai',
            'services_text'    => 'No koncepta skicēm līdz realizētām fasādēm un interjeriem. Izceļam dabisko gaismu, ilgtspējīgus materiālus un precīzas detaļas, lai katrs projekts būtu funkcionāls un vizuāli pārliecinošs.',
            'services_items'   => [
                ['title' => 'Dzīvojamās mājas', 'text' => 'Individuāli risinājumi ar ērtām plānojuma līnijām un plašu stiklojumu.'],
                ['title' => 'Industriālie objekti', 'text' => 'Noliktavas, ražotnes un angāri ar optimizētu dienasgaismu un loģistiku.'],
                ['title' => 'Interjera dizains', 'text' => 'Minimālisma valoda, kas izceļ materiālu faktūru un gaismu.'],
                ['title' => 'Konsultācijas', 'text' => 'Projekta stratēģija, budžeta un materiālu izvēles sesijas.'],
            ],

            'contact_eyebrow' => 'Kontakti',
            'contact_title'   => 'Sazinies ar mums',
            'contact_text'    => 'Pastāsti par savu projektu vai ieplāno klātienes tikšanos Barocco Art studijā.',
            'contact_email'   => 'barocco@baroccoart.lv',
            'contact_phone'   => '+371 26262626',
        ]);
    }
}
