<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Product\ProductsController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ProductsController::class, 'index'])->name('main')->middleware('auth');


Route::put('/add_product', [ProductsController::class, 'addProduct'])->middleware('auth');
Route::post('/remove_product', [ProductsController::class, 'removeProduct'])->middleware('auth');
Route::post('/edit_product', [ProductsController::class, 'editProduct'])->middleware('auth');

Route::get('/register', [LoginController::class, 'register'])->name('login');
Route::get('/login', [LoginController::class, 'login'])->name('login');


Route::post('/makeUser', [RegisterController::class, 'makeUser'])->name('make_account');
Route::post('/auth', [LoginController::class, 'auth'])->name('auth');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
