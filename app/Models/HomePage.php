<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomePage extends Model
{
    protected $fillable = [
        'hero_title', 'hero_text',
        'services_eyebrow', 'services_title', 'services_text', 'services_items',
        'contact_eyebrow', 'contact_title', 'contact_text', 'contact_email', 'contact_phone',
    ];

    protected function casts(): array
    {
        return ['services_items' => 'array'];
    }

    // The home page has exactly one row. Get it, or create an empty one.
    public static function current(): self
    {
        return static::firstOrCreate(['id' => 1]);
    }

    // "+371 26262626" -> "tel:+37126262626"
    public function phoneLink(): string
    {
        return 'tel:' . str_replace(' ', '', (string) $this->contact_phone);
    }
}
