<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'post_id', 
        'name', 
        'email', 
        'website', 
        'comment', 
        'is_approved'
    ];    
    
    public function replies(){
        return $this->hasMany(CommentReplies::class);
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }
}
