<?php

namespace App\Livewire\Profile;

use App\Http\Controllers\DbController;
use Livewire\Component;

class Home extends Component
{
    public $username;
    public $type;

    public function mount($username, $type="posts")
    {
        $this->username = $username;
        $this->type = $type;
    }

    public function render()
    {
        session_start();
        $user = DbController::query('SELECT * FROM users WHERE Username=?', $this->username);
        $isFollowed = DbController::query('SELECT isFollowed FROM isfollowed WHERE  Follower=?', $_SESSION['username']);
        $isFollowed = $isFollowed ? $isFollowed[0]['isFollowed'] : 0;
        $isBlocked = DbController::query('SELECT isBlocked FROM isblocked WHERE Blocker=? AND Blocking=?', $this->username, $_SESSION['username']);
        $isBlocked = $isBlocked ? $isBlocked[0]['isBlocked'] : 0;
        return view('livewire.profile.home')->with([
            'username'=>$this->username,
            'user'=>$user,
            'isFollowed'=>$isFollowed,
            'isBlocked'=>$isBlocked,
            'type'=>$this->type,
        ]);
    }
}
