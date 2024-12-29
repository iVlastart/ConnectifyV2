<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    function makePost(Request $request)
    {
        session_start();
        $content = $request['content'];
        $url="";
        $ID = DbController::query('SELECT ID FROM users WHERE Username=?', $_SESSION['username']);
        $ID = $ID[0]["ID"];
        $hasText = $content!=="" ?true:false;
        $hasMedia = $url!=="" ?true:false;
        DbController::query('INSERT INTO posts (ID, Content, url, hasMedia, hasText) VALUES(?,?,?,?,?)', $ID,$content,$url,$hasMedia, $hasText);
        return redirect('/');
    }

    function toggleLike(Request $request)
    {
        session_start();
        !$request->isLiked
            ? DbController::query('INSERT INTO isliked VALUES(?,?,?)', $_SESSION['username'], $request->postID, !$request->isLiked)
            : DbController::query('DELETE FROM isliked WHERE Username=? AND Post_ID=?', $_SESSION['username'], $request->postID);
    }

    function save(Request $request)
    {
        !$request->isSaved
            ? DbController::query('INSERT INTO issaved VALUES(?,?,?)', $request->saver, $request->postID, 1)
            : DbController::query('DELETE FROM issaved WHERE Saver=? AND Post_ID=?', $request->saver, $request->postID);
    }

    function delete(Request $request)
    {
        $postID=$request->postID;
        if($request->isComment)
        {
            DbController::query('DELETE FROM comments WHERE Post_ID=?', $postID);
        }
        else
        {
            DbController::query('DELETE FROM isliked WHERE Post_ID=?', $postID);
            DbController::query('DELETE FROM posts WHERE Post_ID=?', $postID);
            DbController::query('DELETE FROM reports WHERE Post_ID=?', $postID);
            DbController::query('DELETE FROM issaved WHERE Post_ID=?', $postID);
            DbController::query('DELETE FROM comments WHERE Post_ID=?', $postID);
        }
    }
}
