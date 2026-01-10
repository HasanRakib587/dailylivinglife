<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [        
        
        'category_id',
        'tag_id',

        'title',
        'slug',
        'content',
        'cover_image',
        'thumb_image',
        'long_image',

        'published_at',
        'is_published',
        'is_archived',
        'is_featured',
        'is_trending',

        'meta_description'
    ];

    protected $casts = [
        'images' => 'array',
        'published_at' => 'datetime',
    ];

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeArchived($query)
    {
        return $query->where('is_archived', true);
    }

    public function scopeVisible($query)
    {
        return $query->published()->where('is_archived', false);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
