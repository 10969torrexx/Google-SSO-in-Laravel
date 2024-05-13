<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\GoogleHandlerContoller;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::post('login/google', [GoogleHandlerContoller::class, 'store'])->name('loginGoogle');
# handle google login
Route::middleware(['auth'])->group(function () {
   
});