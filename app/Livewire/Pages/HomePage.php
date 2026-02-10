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
<<<<<<< HEAD

    //public $olderPosts;
    //public $mostCommentedPosts;
    //public int $olderPostsLimit = 4;

    public function mount(){     
=======
    public $olderPosts;
    public $mostCommentedPosts;    

    public int $olderPostsLimit = 4;

    // private $latestPostIds;
>>>>>>> 0c12dafbb7d7bea86b94a8f6262ba66125310271

    public function mount()
    {
        // Latest posts (published & visible)
        $this->latestPosts = Post::published()
            ->where('is_archived', false)
<<<<<<< HEAD
            ->latest('published_at')
=======
            ->orderBy('published_at', 'desc')
>>>>>>> 0c12dafbb7d7bea86b94a8f6262ba66125310271
            ->take(3)
            ->get();       

        $this->archivedPosts = Post::published()
            ->archived()
            ->latest()
            ->take(8)
            ->get();

        // Older posts (published & visible, excluding latest 3) 
<<<<<<< HEAD
        //$this->loadOlderPosts();        
    }

    protected function olderPostsQuery(){
        return Post::published()
            ->where('published_at', '<', now()->subWeeks(2))
            ->whereNotIn('id', $this->latestPosts->pluck('id'))
            ->with('category')
            ->withCount('comments')
            ->latest('published_at');
    }

=======
        $this->loadOlderPosts();        
    }

>>>>>>> 0c12dafbb7d7bea86b94a8f6262ba66125310271
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
        $olderPosts = $this->olderPostsQuery()
            ->take($this->getLimit())
            ->get();
        return view('livewire.pages.home-page', compact('olderPosts'));
    }
}
