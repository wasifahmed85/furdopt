<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{

    use Sluggable;
    protected $fillable = [
        'image',
        'name',
        'slug',
        'status',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

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


    public function breeds()
    {
        return $this->hasMany(SubCategory::class);
    }

    public function pets()
    {
        return $this->hasMany(Pet::class);
    }
}
