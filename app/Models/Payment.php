<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'client_id',
        'visa_id',
        'gross_amount',
        'net_amount',
        'profit_amount',
        'note',
    ];

    // Relations
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function visa()
    {
        return $this->belongsTo(Visa::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
}
