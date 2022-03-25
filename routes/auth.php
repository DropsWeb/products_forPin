<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;


Route::get('/register', function(){
    return view('register');
});

Route::get('/login', function(){
    $user = Auth::user();
    return view('login');
})->name('login');





Route::post('/makeUser', [RegisterController::class, 'newUser'])->name('make_account');
Route::post('/auth', [LoginController::class, 'login'])->name('auth');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
