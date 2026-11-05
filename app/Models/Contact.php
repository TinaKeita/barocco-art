<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['initials', 'role', 'name', 'email', 'phone', 'phone_note', 'sort_order'];

    protected static function booted(): void
    {
        // A new contact goes to the end of the list
        static::creating(function (Contact $contact) {
            if (! $contact->sort_order) {
                $contact->sort_order = (static::max('sort_order') ?? -1) + 1;
            }
        });
    }

    // "+371 2 949 4338" -> "tel:+37129494338"
    public function phoneLink(): string
    {
        return 'tel:' . str_replace(' ', '', (string) $this->phone);
    }
}
