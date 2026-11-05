<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Section extends Model
{
    protected $fillable = ['slug', 'label', 'title', 'intro', 'items', 'sort_order'];

    protected function casts(): array
    {
        // Stored as JSON in the database, used as a normal PHP array in code
        return ['items' => 'array'];
    }

    protected static function booted(): void
    {
        // A new section goes to the end of the list
        static::creating(function (Section $section) {
            if (! $section->sort_order) {
                $section->sort_order = (static::max('sort_order') ?? -1) + 1;
            }
        });

        // Deleting a section: delete its images one by one,
        // so each image's file is removed from storage too
        static::deleting(function (Section $section) {
            $section->images()->get()->each->delete();
        });
    }

    // One section has many images, always in the admin's chosen order
    public function images(): HasMany
    {
        return $this->hasMany(Image::class)->orderBy('sort_order');
    }

    // Lets routes find a section by its slug instead of its id
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
