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
        $postID = !empty($postID) && count($postID) > 0 ? $postID : array();
        return view('livewire.profile.saved')->with([
            "postID"=>$postID
        ]);
    }
}
