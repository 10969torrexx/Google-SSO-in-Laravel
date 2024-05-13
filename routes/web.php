<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\GoogleHandlerContoller;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('login/google', [GoogleHandlerContoller::class, 'store'])->name('loginGoogle');
Route::get('/admin/register', [AdminController::class, 'register'])->name('adminLogin');

Route::middleware(['auth'])->group(function () {
   Route::get('/departments', [AdminController::class, 'departments'])->name('departments');
   Route::post('get/departments', [AdminController::class, 'getDepartments'])->name('getDepartments');
   Route::post('add/departments', [AdminController::class, 'addDepartments'])->name('addDepartments');
   Route::post('edit/departments', [AdminController::class, 'editDepartments'])->name('editDepartments');
   Route::post('delete/departments', [AdminController::class, 'deleteDepartments'])->name('deleteDepartments');
});