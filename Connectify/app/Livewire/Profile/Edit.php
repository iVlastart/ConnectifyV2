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
        return view('livewire.profile.edit')->with([
            'username'=>$this->username,
        ]);
    }
}
