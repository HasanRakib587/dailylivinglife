<?php

namespace App\Livewire\Pages;

use App\Models\Post;
use Livewire\Attributes\Title;
use Livewire\Component;
use Carbon\Carbon;

#[Title('Home')]
class HomePage extends Component
{
    public $latestPosts;
    public $archivedPosts;
    public $olderPosts;
    public $mostCommentedPosts;    

    public int $olderPostsLimit = 4;

    // private $latestPostIds;

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

        // Older posts (published & visible, excluding latest 3) 
        $this->loadOlderPosts();        
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

    public function loadMoreOlderPosts(){
        // $this->olderPostsLimit += 6;
        // $this->loadOlderPosts();
        $alreadyLoadedIds = $this->olderPosts->pluck('id')->merge($this->latestPosts->pluck('id'));
        $newPosts = Post::published()
        ->where('published_at', '<', now()->subWeeks(2))
        ->whereNotIn('id', $alreadyLoadedIds)
        ->orderBy('published_at', 'desc')
        ->take(6)
        ->with('category')
        ->withCount('comments')
        ->get();

        $this->olderPosts = $this->olderPosts->concat($newPosts);
    }

    public function render()
    {
        return view('livewire.pages.home-page');
    }
}
