<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function search(Request $request)
    {
        $search = $request['search'];
    }
}
