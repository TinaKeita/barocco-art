<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // runs all seeders with php artisan db:seed
        $this->call([
            SectionSeeder::class,
            ContactSeeder::class,
            // images need sections so this one goes last
            TestImageSeeder::class,
        ]);
    }
}
