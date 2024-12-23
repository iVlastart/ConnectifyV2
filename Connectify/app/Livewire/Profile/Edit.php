<?php

namespace App\Livewire\Profile;

use Livewire\Component;

class Edit extends Component
{
    public $username;
    function mount($username="")
    {
        $this->username=$username;
    }
    public function render()
    {
        session_start();
        return view('livewire.profile.edit')->with([
            'username'=>$this->username,
        ]);
    }
}
