<?php

namespace App\Livewire\Pages;

use App\Models\Post;
use Livewire\Attributes\Title;
use Livewire\Component;
use Carbon\Carbon;

#[Title('Home')]
class HomePage extends Component
{
    public $archivedPosts;
    public $mostCommentedPosts;
    
    public $latestPosts;
    public $olderPosts;

    public function mount()
    {        
        $this->latestPosts   = Post::published()->latest()->take(3)->get();
        $this->archivedPosts = Post::archived()->take(6)->get();
        $this->olderPosts    = Post::published()
                                    ->where('created_at', '<', now()->subWeeks(2))
                                    ->latest()
                                    ->take(6)
                                    ->get();
    }

    public function render()
    {
        return view('livewire.pages.home-page');
    }
}
