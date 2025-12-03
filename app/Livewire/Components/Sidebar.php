<?php

namespace App\Livewire\Components;

use App\Models\Post;
use Livewire\Component;

class Sidebar extends Component
{
    public $featuredPosts;
    public function mount()
    {
        $this->featuredPosts = Post::query()
                                    ->where('is_featured', true)
                                    ->latest()
                                    ->take(6)
                                    ->get();
    }
    public function render()
    {
        return view('livewire.components.sidebar');
    }
}
