<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OurServiceSlider extends Model
{
    protected $fillable = ['title', 'image','status'];

    public function getImageUrlAttribute()
    {
        return $this->image
            ? asset('storage/'.$this->image)
            : asset('img/avatar.png'); // fallback
    }
}
