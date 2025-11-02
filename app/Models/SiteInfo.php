<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteInfo extends Model
{
    protected $table = 'site_infos';

    protected $fillable = [
        'sitename',
        'site_slogan',
        'logo',
        'about_us',
        'phone',
        'office_phone',
        'office_mail',
        'notice',
    ];

    public function getImageUrlAttribute()
    {
        return $this->logo
            ? asset('storage/' . $this->logo)
            : asset('img/default.jpg'); // fallback
    }
}
