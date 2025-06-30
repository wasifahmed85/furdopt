<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Page extends Model
{
    use Sluggable;
    protected $fillable = [
        'name',
        'slug',
        'title',
        'headline',
        'header',
        'summery',
        'descriptions',
        'serial',
        'status',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'header_menu',
        'footer_menu',
        'terms_status',
        'privacy_status',
        'cookie_status',
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
}
