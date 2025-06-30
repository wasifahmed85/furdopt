<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PetLike extends Model
{
    protected $fillable = ['pet_id', 'user_id','owner_id'];
    
    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }
}
