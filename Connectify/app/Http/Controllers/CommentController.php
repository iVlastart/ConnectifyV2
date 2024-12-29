<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use function Symfony\Component\String\b;

class CommentController extends Controller
{
    function addComment(Request $request)
    {
        DbController::query('INSERT INTO comments (Post_ID, ID, Content) VALUES (?,?,?)', $request->postID, $request->ID, $request->comment);
    }
}
