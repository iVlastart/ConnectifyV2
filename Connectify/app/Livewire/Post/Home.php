<?php

namespace App\Livewire\Post;

use App\Http\Controllers\DbController;
use Livewire\Component;

class Home extends Component
{
    public $postID;
    public function mount($postID=0)
    {
        $this->postID = $postID;
    }
    public function render()
    {
        session_start();
        $post = DbController::query("SELECT * FROM posts WHERE Post_ID=?", $this->postID);
        $user = DbController::query("SELECT * FROM users WHERE ID=?", $post[0]['ID']);
        return view('livewire.post.home')->with([
            'post' => $post,
            'user' => $user,
        ]);
    }
}
