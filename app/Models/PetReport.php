<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PetReport extends Model
{
    protected $fillable = ['pet_id', 'user_id','owner_id','details'];
    
    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }
    
        public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
        public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }
    
}
