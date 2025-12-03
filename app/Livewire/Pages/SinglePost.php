<?php

namespace App\Livewire\Pages;

use App\Models\Post;
use Livewire\Component;

class SinglePost extends Component
{
    public $post;
    public $nextPost;
    public $previousPost;
    public $suggestedPosts;

    public function mount($slug){
        // Fetch the current post
        $this->post = Post::query()
            ->where('slug', $slug)
            ->where('is_published', true)
            ->where('is_archived', false)
            ->with('category') // eager-load category to avoid N+1
            ->firstOrFail();
        
                // Category ID to limit navigation within same category
        $categoryId = $this->post->category_id;

        // Previous Post (older post in same category)
        $this->previousPost = Post::query()
            ->where('category_id', $categoryId)
            ->where('is_published', true)
            ->where('is_archived', false)
            ->where('created_at', '<', $this->post->created_at)
            ->orderBy('created_at', 'desc')
            ->select('id', 'title', 'slug') // only select what you need
            ->first();

        // Next Post (newer post in same category)
        $this->nextPost = Post::query()
            ->where('category_id', $categoryId)
            ->where('is_published', true)
            ->where('is_archived', false)
            ->where('created_at', '>', $this->post->created_at)
            ->orderBy('created_at', 'asc')
            ->select('id', 'title', 'slug')
            ->first();

        $this->suggestedPosts = Post::query()
                                ->where('is_featured', true)
                                ->latest()
                                ->take(3)
                                ->get();
    }
    public function render()
    {
        return view('livewire.pages.single-post');
    }
}
