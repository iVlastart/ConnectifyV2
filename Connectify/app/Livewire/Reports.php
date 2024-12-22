<?php

namespace App\Livewire;

use App\Http\Controllers\DbController;
use Livewire\Component;

class Reports extends Component
{
    public function render()
    {
        session_start();
        $reports = DbController::queryAll('SELECT * FROM reports');
        return view('livewire.reports')->with([
            'reports' => $reports,
        ]);
    }
}
