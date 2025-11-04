<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisaTrack extends Model
{
    protected $fillable = ['applicant_name', 'name', 'reference_number','status', 'pdf'];
    protected static function booted()
    {
        static::addGlobalScope('orderByReference', function ($query) {
            $query->orderByRaw('CAST(reference_number AS UNSIGNED) ASC');
        });
    }
}
