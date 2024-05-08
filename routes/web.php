<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/login/google', function () {
    return Socialite::driver('google')->redirect();
})->name('redirectToGoogle');

Route::post('/login/google/callback', function () {
    $user = Socialite::driver('google')->user();
    return json_encode(array(
        'user' => $user
    ));
});
