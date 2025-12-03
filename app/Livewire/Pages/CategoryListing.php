<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\Category;

class CategoryListing extends Component
{
    public $slug;
    public $category;
    public $parentCategory;
    public $subcategories;
    // public $posts;

    public function mount($slug){
        
        $this->slug = $slug;

        $this->category = Category::query()
                                ->where('is_active', true)
                                ->where('slug', $this->slug)
                                ->with('parent', 'children')
                                ->firstOrFail();
        
        // if this category has a parent, use that as parentCategory
        $this->parentCategory = $this->category->parent ?? $this->category;

        // get all subcategories (children of parent)
        $this->subcategories = $this->parentCategory->children; 
    }
    
    public function render()
    {        
        $posts = $this->category->posts()
                                        ->published()
                                        ->latest()
                                        ->paginate(6);
        return view('livewire.pages.category-listing', [
            'posts' => $posts,
        ]);
    }
}
