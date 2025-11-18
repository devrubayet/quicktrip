<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
     protected $fillable = [
        'name',
        'passport_number',
        'phone',
        'email',
        'dob',
    ];

    // Relations
    public function visas()
    {
        return $this->hasMany(Visa::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
