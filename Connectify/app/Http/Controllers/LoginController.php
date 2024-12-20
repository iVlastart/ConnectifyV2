<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;

    class LoginController extends Controller
    {
        public function login(Request $request)
        {
            
        }

        public function register(Request $request)
        {
            DbController::connect();
            session_start();
        }
    }