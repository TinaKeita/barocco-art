<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Section extends Model
{
    protected $fillable = ['slug', 'label', 'title', 'intro', 'items', 'sort_order'];

    // items is saved as json, this makes it a normal array
    protected function casts(): array
    {
        return ['items' => 'array'];
    }

    // one section has many images
    public function images(): HasMany
    {
        return $this->hasMany(Image::class)->orderBy('sort_order');
    }

    // so the url uses slug instead of id (/pakalpojumi/celtnieciba)
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
