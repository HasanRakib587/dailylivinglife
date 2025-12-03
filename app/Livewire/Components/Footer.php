<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class Footer extends Component
{
    public $profile = [];

    public function mount(){
        if (Storage::disk('local')->exists('author_profile.json')) {
            $this->profile = json_decode(Storage::disk('local')->get('author_profile.json'), true);
        }
    }
    public function render()
    {
        return view('livewire.components.footer');
    }
}
