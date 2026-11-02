<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class TestImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (['1.jpg', '2.jpg', '3.jpg', '4.jpg'] as $i => $file) {
            $path = 'test/' . $file;

            Storage::disk('public')->put(
                $path,
                file_get_contents(database_path('seeders/images/' . $file))
            );

            Image::updateOrCreate(
                ['path' => $path],
                [
                    'alt_text'     => 'Testa attēls',
                    'show_on_home' => true,
                    'sort_order'   => $i,
                ]
            );
        }
    }
}
