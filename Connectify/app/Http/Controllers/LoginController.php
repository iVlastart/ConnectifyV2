<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Http\Controllers\DbController;

use function Laravel\Prompts\alert;

    class LoginController extends Controller
    {
        public function login(Request $request)
        {
            DbController::connect();
            session_start();
            $username = strip_tags($request["username"]);
            $password = strip_tags($request["password"]);
            $users = DbController::query('SELECT Username, Password FROM Users WHERE Username=?', $username);
            if(!$users) return redirect('login'); 
            $dbUsername = $users[0]["Username"];
            $hash = $users[0]["Password"];
            if($username===$dbUsername && password_verify($password, $hash))
            {
                $_SESSION["username"]=$username;
                return redirect('/');
            }
        }

        public function register(Request $request)
        {
            DbController::connect();
            session_start();
            $username = strip_tags($request["username"]);
            $password = strip_tags($request["password"]);
            $hash = password_hash($password, PASSWORD_DEFAULT);
            if(DbController::query('SELECT Username FROM users WHERE Username=?', $username))
            {
                return redirect('/register');
            }
            if($username!=="" && $password!=="")
            {
                DbController::query('INSERT INTO users (Username, Password) VALUES (?,?)', $username, $hash);
                $_SESSION['username'] = $username;
                return redirect('/');
            }
        }
    }