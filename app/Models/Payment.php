<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'subscription_id',
        'subscription_plan_id',
        'payment_gateway',
        'transaction_id',
        'amount',
        'status',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subcription()
    {
        return $this->belongsTo(SubscriptionPlan::class, 'subscription_plan_id', 'id');
    }
}
