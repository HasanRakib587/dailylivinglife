<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Models\Post;
use App\Models\Comment;
use App\Models\CommentReplies;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\Auth;
use App\Filament\Resources\PostResource;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action;

class Comments extends Page
{
    protected static string $resource = PostResource::class;
    protected static string $view = 'filament.resources.post-resource.pages.comments';

    public $record;
    public Post $post;
    public ?int $replyingTo = null;
    public string $replyText = '';

    public function mount($record)
    {
        $this->record = $record;
        $this->post = Post::with([
                        'comments.replies' => function ($query) {
                            $query->latest(); // ORDER BY created_at DESC
                        },
                    ])->findOrFail($record);                                            
    }

    public function deleteComment($commentId)
    {
        Comment::findOrFail($commentId)->delete();
        $this->refreshComments();
        Notification::make()
            ->title('Comment deleted successfully.')
            ->success()
            ->send();
    }

    public function deleteReply($replyId)
    {
        $reply = CommentReplies::find($replyId);
        if ($reply) {
            $reply->delete();
            $this->refreshComments();
            Notification::make()
                ->title('Reply deleted successfully.')
                ->success()
                ->send();
        } else {
            Notification::make()
                ->title('Reply not found.')
                ->danger()
                ->send();
        }
    }

    public function startReply($commentId)
    {
        $this->replyingTo = $commentId;
        $this->replyText = '';
    }

    public function cancelReply(){
        $this->replyingTo = null;
        $this->replyText = '';
    }
    
    public function submitReply(){
        if (trim($this->replyText) === '') return;

        CommentReplies::create([
            'comment_id'   => $this->replyingTo,            
            'name'      => Auth::user()->name, // or Auth::user()->name               
            'email' => 'admin@dailylivinglife.com', // ✅ Add this line
            'reply'     => $this->replyText,
        ]);

        $this->cancelReply();
        $this->refreshComments();

        Notification::make()
            ->title('Reply added successfully.')
            ->success()
            ->send();
    }

    protected function refreshComments(){
        $this->post->load([
        'comments.replies' => function ($query) {
                $query->latest();
            },
        ]);
    }
}
