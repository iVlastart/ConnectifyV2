<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DbController;

class ReportController extends Controller
{
    function reportPost(Request $request)
    {
        $success = DbController::query('INSERT INTO reports VALUES (?, ?, ?)', $request->postID, $request->username, $request->isComment);
    }
}
