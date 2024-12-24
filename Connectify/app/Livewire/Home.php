<?php

namespace App\Livewire;

use App\Http\Controllers\DbController;
use App\Livewire\Post\Item;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class Home extends Component
{

    public function mount()
    {
        session_start();
        if(!isset($_SESSION['username']) || empty($_SESSION['username'])) return Redirect::to('/login');
    }
    public function render()
    {
        if($_SESSION['username']==="") return redirect('login');
        $users = DbController::queryAll('SELECT * FROM users WHERE Username=?', $_SESSION['username']);
        foreach($users as $user)
        {
            $pfp = $user['Pfp'];
        }
        return view('livewire.home')->with([
            'pfp'=>$pfp,
        ]);
    }
}
