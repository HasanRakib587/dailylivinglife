<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Category;

class Navbar extends Component
{
    public $categories;
    public function mount(){        
        $this->categories = Category::query()
                            ->whereNull('parent_id')
                            ->with('children')
                            ->get();        
    }
    public function render()
    {
        return view('livewire.components.navbar');
    }
}
