<?php

namespace App\Livewire\Pages;

use Carbon\Carbon;
use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\Title;
use App\Livewire\Concerns\WithLoadMore;

#[Title('Home')]
class HomePage extends Component
{
    use WithLoadMore;
    public $latestPosts;
    public $archivedPosts;
    
    public function mount()
    {
        // Latest posts (published & visible)
        $this->latestPosts = Post::published()
            ->where('is_archived', false)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();       

        $this->archivedPosts = Post::published()
            ->archived()
            ->latest()
            ->take(8)
            ->get();       
    }

    protected function olderPostsQuery(){
        return Post::published()
            ->where('published_at', '<', now()->subWeeks(2))
            ->whereNotIn('id', $this->latestPosts->pluck('id'))
            ->with('category')
            ->withCount('comments')
            ->latest('published_at');
    }

    public function loadOlderPosts(){
        $latestPostIds = $this->latestPosts->pluck('id');
        $this->olderPosts    = Post::published()
            ->where('published_at', '<', now()->subWeeks(2))
            ->whereNotIn('id', $latestPostIds) // exclude latest
            ->orderBy('published_at', 'desc')            
            ->take($this->olderPostsLimit)
            ->with('category')            
            ->withCount('comments')
            ->get();
    }

    public function render()
    {
        $olderPosts = $this->olderPostsQuery()
            ->take($this->getLimit())
            ->get();
        return view('livewire.pages.home-page', compact('olderPosts'));
    }
}
