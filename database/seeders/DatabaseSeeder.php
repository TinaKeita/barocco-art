<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    // `php artisan db:seed` (or `migrate:fresh --seed`) runs these in order.
    // Sections first, because test images link to them.
    public function run(): void
    {
        $this->call([
            HomePageSeeder::class,
            SectionSeeder::class,
            ContactSeeder::class,
            TestImageSeeder::class,
        ]);
    }
}
