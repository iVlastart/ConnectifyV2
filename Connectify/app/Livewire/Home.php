<?php

namespace App\Livewire;

use App\Http\Controllers\DbController;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        session_start();
        $users = DbController::queryAll('SELECT * FROM users WHERE Username=?', $_SESSION['username']);
        foreach($users as $user)
        {
            $pfp = $user['Pfp'];
        }
        return view('livewire.home')->with([
            'pfp'=>$pfp
        ]);
    }
}
