<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
     protected $fillable = [
        'client_id',
        'visa_id',
        'payment_id',
        'invoice_number',
        'total_amount',
        'invoice_date',
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

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
