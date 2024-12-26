<?php

namespace App\Livewire\Profile;

use App\Http\Controllers\DbController;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class Home extends Component
{
    public $username;
    public $type;

    public function mount($username, $type="posts")
    {
        session_start();
        $this->username = $username;
        $this->type = $type;

        $user = DbController::query('SELECT * FROM users WHERE Username=?', $this->username);
        if(!$user) return Redirect::to('/profile/' . $_SESSION['username']);
        if(!isset($_SESSION['username']) || empty($_SESSION['username'])) return Redirect::to('/login');
    }

    public function render()
    {
        $user = DbController::query('SELECT * FROM users WHERE Username=?', $this->username);
        $isFollowed = DbController::query('SELECT isFollowed FROM isfollowed WHERE Follower=? AND FOLLOWING=?', $_SESSION['username'], $this->username);
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
