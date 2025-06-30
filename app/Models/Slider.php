<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable=[
        'caption1',
        'caption2',
        'caption3',
        'url',
        'image',
        'status',
    ];
}
