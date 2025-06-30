<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WaletDetail extends Model
{
    protected $fillable = [
        'user_id',
        'walet_id',
        'amount',
        'transaction_id',
        'transaction_type',
    ];
}
