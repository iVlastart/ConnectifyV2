<?php

namespace App\Livewire\Post;

use DateTime;
use Livewire\Component;

class Item extends Component
{
    public $username;
    public $content;
    public $hasMedia;
    public $hasText;
    public $postDate;

    public function mount($username = 'guest', $content="Hello, World!", $hasMedia=false, $hasText=false, $postDate="Today") // Default value
    {
        $this->username = $username;
        $this->content = $content;
        $this->hasMedia = $hasMedia;
        $this->hasText = $hasText;
        $this->postDate = $postDate;
    }
    public function render()
    {
        return view('livewire.post.item');
    }
}
