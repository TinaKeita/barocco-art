<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    // fields that can be filled with create()
    protected $fillable = ['initials', 'role', 'name', 'email', 'phone', 'phone_note', 'sort_order'];

    // removes spaces so the tel: link works on phones
    public function phoneLink(): string
    {
        return 'tel:' . str_replace(' ', '', (string) $this->phone);
    }
}
