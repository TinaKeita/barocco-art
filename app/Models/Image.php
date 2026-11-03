<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    // fields that can be filled with create()
    protected $fillable = ['section_id', 'path', 'alt_text', 'show_on_home', 'sort_order'];

    protected function casts(): array
    {
        return ['show_on_home' => 'boolean'];
    }

    // every image belongs to one section
    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    // full link to the image in storage folder
    public function url(): string
    {
        return asset('storage/' . $this->path);
    }
}
