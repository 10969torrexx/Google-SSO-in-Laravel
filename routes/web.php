<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/login/google', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/login/google/callback', function () {
    $user = Socialite::driver('google')->user();
    // Handle the authenticated user
    // For example, create a new user if it doesn't exist or log in the existing user
});
