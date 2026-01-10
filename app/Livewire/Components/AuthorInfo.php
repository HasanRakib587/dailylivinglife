<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class AuthorInfo extends Component
{
    public $profile = [];    
    public function mount()
    {
       $path = public_path('uploads/author_profile.json');

        if (!file_exists($path)) {
            // Return default data if the file doesn’t exist
            return [
                'name' => 'Author Name',
                'bio' => '',
                'avatar' => null,
                'social_links' => [],
            ];
        }

        $contents = file_get_contents($path);
        $data = json_decode($contents, true);

        // Return decoded JSON or an empty array if invalid
        $this->profile = is_array($data) ? $data : [];
    }
    public function render()
    {
        return view('livewire.components.author-info');
    }
}
