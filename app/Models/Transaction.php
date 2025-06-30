<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'trans_no',
        'amount',
        'remarks',
        'payment_method',
    ];
}
