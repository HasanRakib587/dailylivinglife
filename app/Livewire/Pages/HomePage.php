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
    public $olderPosts;
    public $archivedPosts;
    public $mostCommentedPosts;    

    public function mount()
    {        
        // $this->latestPosts   = Post::published()->latest()->take(3)->get();

        // Latest posts (published & visible)
        $this->latestPosts = Post::query()->published()->where('is_archived', false)
            ->latest()
            ->take(5)
            ->get();

        // $this->archivedPosts = Post::archived()->take(6)->get();
        $this->archivedPosts = Post::query()->published()->archived()->latest()->take(8)->get();

        // Older posts (published & visible, excluding latest) 
        $this->olderPosts    = Post::query()
            ->published()
            ->archived()
            ->latest()
            ->take(6)
            ->with('category')
            ->where('created_at', '<', now()->subWeeks(2))
            ->get();
    }

    public function render()
    {
        return view('livewire.pages.home-page');
    }
}
