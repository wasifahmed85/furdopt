<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class SubscriptionPlan extends Model
{

    use Sluggable;
    protected $fillable = [
        'name',
        'slug',
        'type',
        'duration',
        'spotlight',
        'price',
        'max_pets_allowed',
        'can_feature_pets',
        'can_top_search_pets',
        'status',
        'descriptions',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function isValid()
    {
        $startDate = $this->pivot->created_at; // Assuming pivot table stores subscription start date
        $durationInMonths = $this->duration;

        $expiryDate = Carbon::parse($startDate)->addMonths($durationInMonths);
        return Carbon::now()->lessThan($expiryDate);
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
