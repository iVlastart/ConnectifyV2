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
    public $url;
    public $isLiked;
    public $postID;

    public function mount($username = 'guest', $content="Hello, World!", $hasMedia=false, $hasText=false, $postDate="Today", $url="", $isLiked=false, $postID=0) // Default value
    {
        $this->username = $username;
        $this->content = $content;
        $this->hasMedia = $hasMedia;
        $this->hasText = $hasText;
        $this->postDate = $postDate;
        $this->url = $url;
        $this->isLiked = $isLiked;
        $this->postID = $postID;
    }
    public function render()
    {
        return view('livewire.post.item');
    }
}
