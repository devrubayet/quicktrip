<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankDetail extends Model
{
    protected $fillable = [
        'bank_name',
        'account_name',
        'account_number',
        'branch_name',
        'swift_code',
        'routing_number'
    ];

}
