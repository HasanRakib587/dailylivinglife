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

    public int $olderPostsLimit = 6;

    public function mount()
    {
        // Latest posts (published & visible)
        $this->latestPosts = Post::published()
            ->where('is_archived', false)
            ->latest()
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
        $this->olderPosts    = Post::published()
            ->where('published_at', '<', now()->subWeeks(2))
            // ->latest()
            ->orderBy('published_at', 'desc')
            ->skip(3) // 👈 skip the 3 latest posts already shown above
            ->take($this->olderPostsLimit)
            ->with('category')            
            ->withCount('comments')
            ->get();
    }

    public function loadMoreOlderPosts(){
        $this->olderPostsLimit += 6;
        $this->loadOlderPosts();
    }

    public function render()
    {
        return view('livewire.pages.home-page');
    }
}
