<?php

namespace App\Livewire\Profile;

use App\Http\Controllers\DbController;
use Livewire\Component;

class Posts extends Component
{
    public $username;

    public function mount($username="guest")
    {
        $this->username = $username;
    }
    public function render()
    {
        $ID = DbController::query('SELECT ID FROM users WHERE Username=?', $this->username);
        $posts = DbController::query('SELECT * FROM posts WHERE ID=? ORDER BY Post_ID DESC', $ID[0]['ID']);
        return view('livewire.profile.posts')->with([
            'posts' => $posts,
        ]);
    }
}
