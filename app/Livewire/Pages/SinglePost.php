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

    public function mount(string $slug){

        // Current post (ONLY published & not archived)
        $this->post = Post::query()
            ->published()
            ->where('is_archived', false)
            ->where('slug', $slug)
            // ->where('is_published', true)
            ->with('category', 'tags') // eager-load category to avoid N+1
            ->firstOrFail();
        
        // Category ID to limit navigation within same category
        $categoryId = $this->post->category_id;

        // Previous Post (older post in same category)
        $this->previousPost = Post::query()
            ->published()
            ->where('is_archived', false)
            ->where('category_id', $categoryId)
            ->where('is_published', true)
            ->where('created_at', '<', $this->post->created_at)
            ->orderByDesc('created_at')
            ->select('id', 'title', 'slug') // only select what you need
            ->first();

        // Next Post (newer post in same category)
        $this->nextPost = Post::query()
            ->published()
            ->where('is_archived', false)
            ->where('category_id', $categoryId)
            // ->where('is_published', true)
            ->where('created_at', '>', $this->post->created_at)
            ->orderBy('created_at')
            ->select('id', 'title', 'slug')
            ->first();

        $this->suggestedPosts = Post::query()
            ->published()
            ->where('is_archived', false)
            ->featured()
            ->latest()
            ->limit(3)
            ->get(['id', 'title', 'slug', 'cover_image']);
    }
    public function render()
    {
        return view('livewire.pages.single-post');
    }
}
