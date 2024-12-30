<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use function Symfony\Component\String\b;

class CommentController extends Controller
{
    function addComment(Request $request)
    {
        DbController::query('INSERT INTO comments (orgComment_ID, Post_ID, ID, Content, isReply) VALUES (?,?,?,?,?)', $request->orgCommentID, $request->postID, $request->ID, $request->comment, $request->isReply);
    }

    function destroy(Request $request)
    {
        DbController::query('DELETE FROM comments WHERE Comment_ID=? OR orgComment_ID=?', $request->commentID, $request->commentID);
    }

    function destroyReply(Request $request)
    {
        DbController::query('DELETE FROM comments WHERE Comment_ID=?', $request->commentID);
    }
}
