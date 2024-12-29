<?php

namespace App\Livewire\Post;

use Livewire\Component;

class Comment extends Component
{
    public $username;
    public $isVerified;
    public $commentDate;
    public $postID;
    public $commentID;

    public function mount($username="Commenter", $isVerified=false, $commentDate="Today", $postID=0, $commentID=0)
    {
        $this->username = $username;
        $this->isVerified = $isVerified;
        $this->commentDate = $commentDate;
        $this->postID = $postID;
        $this->commentID = $commentID;
    }
    public function render()
    {
        return view('livewire.post.comment');
    }
}
