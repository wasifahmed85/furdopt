<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UkState extends Model
{
    protected $fillable = [
        'code',
        'state',
        'status',
    ];
}
