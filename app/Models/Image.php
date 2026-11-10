<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    protected $fillable = ['section_id', 'path', 'caption', 'show_on_home', 'sort_order'];

    protected function casts(): array
    {
        return ['show_on_home' => 'boolean'];
    }

    protected static function booted(): void
    {
        // Image row deleted in the admin -> delete the file too
        static::deleted(function (Image $image) {
            Storage::disk('public')->delete($image->path);
        });

        // Image replaced with a new upload -> delete the old file
        static::updated(function (Image $image) {
            if ($image->wasChanged('path') && $image->getOriginal('path')) {
                Storage::disk('public')->delete($image->getOriginal('path'));
            }
        });
    }

    // The section this image belongs to
    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    // hidden alt text = name of the section, like "Celtniecība"
    public function altText(): string
    {
        return $this->section?->label ?? 'Barocco Art';
    }

    public function url(): string
    {
        return asset('storage/' . $this->path);
    }
}
