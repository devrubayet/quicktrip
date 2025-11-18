<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visa extends Model
{
    protected $fillable = ['client_id','applicant_name', 'name', 'reference_number','status', 'pdf'];
    protected static function booted()
    {
        static::addGlobalScope('orderByReference', function ($query) {
            $query->orderByRaw('CAST(reference_number AS UNSIGNED) ASC');
        });
    }

    // Relations
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function payments()
    {
        return $this->hasOne(Payment::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}

