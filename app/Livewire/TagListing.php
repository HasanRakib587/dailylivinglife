<?php

namespace App\Livewire;

use App\Models\Tag;
use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\Title;
use App\Livewire\Concerns\WithLoadMore;

#[Title('Tags')]
class TagListing extends Component
{
    use WithLoadMore;
    public Tag $tag;

    public function mount(string $slug)
    {
        $this->tag = Tag::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        $posts = $this->tag
                    ->posts()
                    ->published()
                    ->latest()
                    ->take($this->getLimit())
                    ->get();
        return view('livewire.tag-listing', compact('posts'));
    }
}
