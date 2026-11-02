<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['section_id', 'path', 'alt_text', 'show_on_home', 'sort_order'];

    protected function casts(): array
    {
        return ['show_on_home' => 'boolean'];
    }

    public function url(): string
    {
        return asset('storage/' . $this->path);
    }
}