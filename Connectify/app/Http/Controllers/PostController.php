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
}
