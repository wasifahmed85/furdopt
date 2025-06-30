<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PetSoptlight extends Model
{
    protected $fillable = [
        'pet_id',
        'user_id',
        'end_date',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }
}
