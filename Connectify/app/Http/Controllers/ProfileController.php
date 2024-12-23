<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DbController;

use function Pest\Laravel\json;

class ProfileController extends Controller
{
    function suspend(Request $request)
    {
        session_start();
        $request->username==='Connectify' 
            ? DbController::query('')
            :DbController::query('UPDATE users SET Suspended=? WHERE Username=?', 1, $request->username);
    }

    function follow(Request $request)
    {
        session_start();
        $followers = DbController::query('SELECT Followers FROM users WHERE Username=?', $request->following);
        $following = DbController::query('SELECT Following FROM users WHERE Username=?', $_SESSION['username']);
        if($request->isFollowed) 
        {
            //unfollow
            DbController::query('DELETE FROM isfollowed WHERE Follower=? AND Following=?', $_SESSION['username'], $request->following);
            $followers[0]['Followers']--;
            $following[0]['Following']--;
            DbController::query('UPDATE users SET Followers=? WHERE Username=?', $followers[0]['Followers'], $request->following);
            DbController::query('UPDATE users SET Following=? WHERE Username=?', $following[0]['Following'], $_SESSION['username']);
        }
        else
        {
            //follow
            DbController::query('INSERT INTO isfollowed VALUES (?,?,?)', $_SESSION['username'], $request->following,1);
            $followers[0]['Followers']++;
            $following[0]['Following']++;
            DbController::query('UPDATE users SET Followers=? WHERE Username=?', $followers[0]['Followers'], $request->following);
            DbController::query('UPDATE users SET Following=? WHERE Username=?', $following[0]['Following'], $_SESSION['username']);
        }
    }

    function edit(Request $request)
    {
        session_start();
        switch($request->type)
        {
            case 'username':
                $this->updateUsername($request->username);
                break;
            case 'password':
                $this->updatePassword($request->oldPass, $request->newPass);
                break;
        }
    }

    function search($search)
    {
        $users = DbController::queryAll('SELECT * FROM users WHERE Username LIKE ?', "%$search%");
        return response()->json([
            'users'=>$users
        ]);
    }

    function updateUsername($username)
    {
        if(!DbController::query('SELECT Username FROM users WHERE Username=?', $username))
        {
            DbController::query('UPDATE users SET Username=? WHERE Username=?', $username, $_SESSION['username']);
            $_SESSION['username']=$username;
        }
    }

    function updatePassword($old, $new)
    {
        $password = DbController::query('SELECT Password FROM users WHERE Username=?', $_SESSION['username']);
        if(password_verify($old, $password[0]['Password']))
        {
            DbController::query('UPDATE users SET Password=? WHERE Username=?', password_hash($new, PASSWORD_DEFAULT), $_SESSION['username']);
        }
    }

    function block(Request $request)
    {
        !DbController::query('SELECT * FROM isblocked WHERE Blocker=? AND Blocking=?', $request->blocker, $request->blocking)
            ? DbController::query('INSERT INTO isblocked VALUES (?,?,?)', $request->blocker, $request->blocking, 1)
            : DbController::query('DELETE FROM isblocked WHERE Blocker=? AND Blocking=?', $request->blocker, $request->blocking);

    }

    function destroy($username)
    {
        session_start();
        if($username!==$_SESSION['username']) return redirect('/destroy/'.$_SESSION['username']);
        if($username==='Connectify') return redirect('/');
        
    }
}