<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Signin;
use App\Livewire\Explore;
use App\Livewire\Search;
use App\Livewire\Home;
use App\Livewire\Profile\Edit as ProfileEdit;
use App\Livewire\Profile\Home as ProfileHome;
use App\Livewire\Reports;
use Illuminate\Support\Facades\Route;

//app routes
Route::get('/', Home::class)->name('home');
Route::post('/', [PostController::class, 'makePost'])->name('post');

//profile routes
Route::get('/profile/{username}/', ProfileHome::class)->name('profile');
Route::get('/profile/{username}/{type}', ProfileHome::class)->name('profile');
Route::get('/profile/{username}/edit', ProfileEdit::class)->name('profile.edit');
Route::get('/destroy/{username}', [ProfileController::class, 'destroy'])->name('destroy');

//admin routes
Route::get('/reports', Reports::class)->name('reports');

//auth routes
Route::get('/login', Login::class)->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/register', Login::class)->name('signin');
Route::post('/register', [LoginController::class, 'register'])->name('signin');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


//ajax routes
Route::post('/likePost', [PostController::class, 'toggleLike'])->name('likePost');
Route::post('/report', [ReportController::class, 'reportPost'])->name('report');
Route::post('/suspend', [ProfileController::class, 'suspend'])->name('suspend');
Route::post('/delete', [PostController::class, 'delete'])->name('delete');
Route::post('/follow', [ProfileController::class, 'follow'])->name('follow');
Route::post('/edit', [ProfileController::class, 'edit'])->name('edit');
Route::get('/search/{search}', [ProfileController::class, 'search'])->name('search');
Route::post('/block', [ProfileController::class, 'block'])->name('block');
Route::post('/save', [PostController::class, 'save'])->name('save');