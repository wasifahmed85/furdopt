<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = [
        'promotion_name',
        'promotion_days',
        'spotlight',
        'price',
        'status',
    ];
}
