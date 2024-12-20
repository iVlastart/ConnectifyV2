<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Signin;
use App\Livewire\Explore;
use App\Livewire\Search;
use App\Livewire\Home;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::post('/', [UserController::class, 'search'])->name('search');
Route::get('/login', Login::class)->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/register', Login::class)->name('signin');
Route::post('/register', [LoginController::class, 'register'])->name('signin');
