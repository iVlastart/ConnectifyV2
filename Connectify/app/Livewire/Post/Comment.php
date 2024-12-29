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
    public $content;

    public function mount($username="Commenter", $isVerified=false, $commentDate="Today", $postID=0, $commentID=0, $content="New comment")
    {
        $this->username = $username;
        $this->isVerified = $isVerified;
        $this->commentDate = $commentDate;
        $this->postID = $postID;
        $this->commentID = $commentID;
        $this->content = $content;
    }
    public function render()
    {
        return view('livewire.post.comment');
    }
}
