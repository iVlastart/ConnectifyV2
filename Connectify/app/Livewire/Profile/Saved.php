<?php

namespace App\Livewire\Profile;

use App\Http\Controllers\DbController;
use Livewire\Component;

class Saved extends Component
{
    public $username;
    public function mount($username="guest")
    {
        $this->username = $username;
    }
    public function render()
    {
        $postID = DbController::query('SELECT Post_ID FROM isSaved WHERE Saver=?', $this->username);
        $postID = !empty($postID) && count($postID) > 0 ? $postID[0]['Post_ID'] : 0;
        $posts = DbController::queryAll('SELECT * FROM Posts WHERE Post_ID=? ORDER BY Post_ID DESC', $postID);
        return view('livewire.profile.saved')->with([
            "posts"=>$posts
        ]);
    }
}
