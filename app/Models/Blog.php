<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'blog_title',
        'slug',
        'image',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'blog_title',
            ]
            ];
    }

    public function getImageAttribute($image)
    {
        if ($image != null) {
            return asset($image);
        }

        return false;
    }
}
