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
        $data = new \stdClass();
        $data->postID = $request->postID;
        $data->isLiked = $request->isLiked;
        !$data->isLiked
        ? DbController::query('INSERT INTO isliked VALUES(?,?,?)', $_SESSION['username'], $data->postID, !$data->isLiked)
        : DbController::query('DELETE FROM isliked WHERE Username=? AND Post_ID=?', $_SESSION['username'], $data->postID);
    }
}
