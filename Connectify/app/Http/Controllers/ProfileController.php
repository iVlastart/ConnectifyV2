<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DbController;

class ProfileController extends Controller
{
    function suspend(Request $request)
    {
        session_start();
        $_SESSION['username']==='Connectify' 
            ? DbController::query('')
            :DbController::query('UPDATE users SET Suspended=? WHERE Username=?', 1, $request->username);
    }
}
