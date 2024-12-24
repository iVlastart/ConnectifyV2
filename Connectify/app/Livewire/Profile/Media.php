<?php

namespace App\Livewire\Profile;

use App\Http\Controllers\DbController;
use Livewire\Component;

class Media extends Component
{
    public $username;
    function mount($username="guest")
    {
        $this->username = $username;
    }
    public function render()
    {
        $ID = DbController::query('SELECT ID FROM users WHERE Username=?', $this->username);
        $posts = DbController::queryAll('SELECT * FROM posts WHERE ID=? AND hasMedia=? ORDER BY Post_ID DESC', $ID[0]['ID'], 1);
        return view('livewire.profile.media')->with([
            'username'=>$this->username,
            'posts'=>$posts
        ]);
    }
}
