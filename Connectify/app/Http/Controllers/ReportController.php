<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DbController;

class ReportController extends Controller
{
    function reportPost(Request $request)
    {
        $data = new \stdClass();
        $data->postID = $request->postID;
        $data->username = $request->username;
        $success = DbController::query('INSERT INTO reports VALUES (?, ?)', $data->postID, $data->username);
    }
}
