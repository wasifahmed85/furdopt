<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Walet extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'last_transaction_id',
        'last_transaction_type',

    ];
}
