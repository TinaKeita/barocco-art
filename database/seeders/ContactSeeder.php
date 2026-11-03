<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    public function run(): void
    {
        // contacts shown on the contacts page
        $contacts = [
            [
                'initials'   => 'AL',
                'role'       => 'Arhitektūra, projektēšana',
                'name'       => 'Armands Lūsis',
                'email'      => 'armands@baroccoart.lv',
                'phone'      => '+371 2 949 4338',
                'phone_note' => 'gsm',
            ],
            [
                'initials'   => 'BI',
                'role'       => 'Birojs',
                'name'       => 'Brīvības iela 137 Rīga, Latvija',
                'email'      => 'barocco@baroccoart.lv',
                'phone'      => '+371 26262626',
                'phone_note' => 'WhatsApp',
            ],
        ];

        foreach ($contacts as $i => $data) {
            // updateOrCreate so running the seeder again doesnt make copies
            Contact::updateOrCreate(
                ['email' => $data['email']],
                $data + ['sort_order' => $i]
            );
        }
    }
}
