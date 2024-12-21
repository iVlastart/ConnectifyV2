<?php

namespace App\Livewire\Profile;

use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        session_start();
        return view('livewire.profile.home');
    }
}
