<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentReplies extends Model
{
    protected $fillable = [
        'comment_id', 
        'name', 
        'email', 
        'website', 
        'reply', 
        'is_approved'
    ];

    public function comment() {
        return $this->belongsTo(Comment::class);
    }
}
