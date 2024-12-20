<?php

namespace App\Livewire\Post;

use Livewire\Component;

class Item extends Component
{
    public $username;
    public $content;
    public $hasMedia;
    public $hasText;

    public function mount($username = 'guest', $content="Hello, World!", $hasMedia=false, $hasText=false) // Default value
    {
        $this->username = $username;
        $this->content = $content;
        $this->hasMedia = $hasMedia;
        $this->hasText = $hasText;
    }
    public function render()
    {
        return view('livewire.post.item');
    }
}
