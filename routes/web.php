<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
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

Route::get('/', function () {
    $products = ProductsController::get_product();
    $user = Auth::user();
    return view('main', ['products' => $products, 'user' => $user]);
})->name('main')->middleware('auth');

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

Route::put('/add_product', [ProductsController::class, 'add_product']);


Route::post('/remove_product', [ProductsController::class, 'remove_product']);
Route::post('/edit_product', [ProductsController::class, 'edit_product']);
