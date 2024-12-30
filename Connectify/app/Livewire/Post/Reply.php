<?php

namespace App\Livewire\Post;

use Livewire\Component;

class Reply extends Component
{
    public $commentID;
    public $username;
    public $replyDate;
    public $isVerified;
    public $content;

    public function mount($commentID=0, $username="guest", $replyDate="Today", $isVerified=false, $content="A reply")
    {
        $this->commentID = $commentID;
        $this->username = $username;
        $this->replyDate = $replyDate;
        $this->isVerified = $isVerified;
        $this->content = $content;
    }
    public function render()
    {
        return view('livewire.post.reply');
    }
}
