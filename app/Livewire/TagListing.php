<?php

namespace App\Livewire;

use App\Models\Tag;
use Livewire\Component;

class TagListing extends Component
{
    public function mount(string $slug)
    {
        $this->tag = Tag::where('slug', $slug)->firstOrFail();
        $this->posts = $this->tag->posts()->published()->get();
    }

    public function render()
    {
        return view('livewire.tag-listing');
    }
}
