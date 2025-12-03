<?php

namespace App\Livewire\Components;

use App\Models\Post;
use App\Models\Comment;
use Livewire\Component;
use App\Models\CommentReplies;

class Comments extends Component
{
    public Post $post;
    public $name, $email, $website, $comment;
    public $replyText = '', $replyingTo = null;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'comment' => 'required|string|max:1000',
        'website' => 'nullable|string|max:255',
    ];

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function addComment()
    {
        $this->validate();

        Comment::create([
            'post_id' => $this->post->id,
            'name' => $this->name,
            'email' => $this->email,
            'website' => $this->website,
            'comment' => $this->comment,
            'is_approved' => true, // auto approve or set false for moderation
        ]);

        $this->reset(['name','email','website','comment']);
        session()->flash('message', 'Comment posted!');
    }

    public function addReply($commentId)
    {
        $this->validate([
            'replyText' => 'required|string|max:1000',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        CommentReplies::create([
            'comment_id' => $commentId,
            'name' => $this->name,
            'email' => $this->email,
            'website' => $this->website,
            'reply' => $this->replyText,
            'is_approved' => true,
        ]);

        $this->reset(['name', 'email', 'replyText']);
        session()->flash('message', 'Reply posted!');
    }

    public function deleteComment($commentId)
    {
        Comment::find($commentId)?->delete();
        session()->flash('message', 'Comment deleted!');
    }

    public function render()
    {
        $comments = $this->post->comments()->with('replies')->latest()->get();
        return view('livewire.components.comments', compact('comments'));
    }
}
