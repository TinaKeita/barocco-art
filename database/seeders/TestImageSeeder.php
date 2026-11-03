<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Section;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class TestImageSeeder extends Seeder
{
    public function run(): void
    {
        // delete old test images first so they dont duplicate
        Image::where('path', 'like', 'test/%')->delete();

        // image file => section slug
        $files = [
            '1.jpg' => 'celtnieciba',
            '2.jpg' => 'projektesana',
            '3.jpg' => 'interjera-dizains',
            '4.jpg' => 'projektu-vadiba',
        ];

        $i = 0;

        foreach ($files as $file => $slug) {
            $source = database_path('seeders/images/' . $file);

            // skip if the picture is missing
            if (! file_exists($source)) {
                $this->command->warn("Skipped {$file}: not found in database/seeders/images/");
                continue;
            }

            $path = 'test/' . $file;
            // copy image to storage so the site can show it
            Storage::disk('public')->put($path, file_get_contents($source));

            Image::create([
                'section_id'   => Section::where('slug', $slug)->value('id'),
                'path'         => $path,
                'alt_text'     => 'Testa attēls',
                'show_on_home' => true,
                'sort_order'   => $i++,
            ]);
        }
    }
}