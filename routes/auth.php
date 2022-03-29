<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;



Route::get('/register', [LoginController::class, 'register'])->name('login');
Route::get('/login', [LoginController::class, 'login'])->name('login');


Route::post('/makeUser', [RegisterController::class, 'makeUser'])->name('make_account');
Route::post('/auth', [LoginController::class, 'auth'])->name('auth');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
