<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model

{

    protected $fillable = ['name','avatar','bio','message'];
    public function getImageUrlAttribute()
    {
        return $this->avatar
            ? asset('storage/' . $this->avatar)
            : asset('avatars/avatar.png'); // fallback
    }
}
