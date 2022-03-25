<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    $products = ProductsController::get_product();
    $user = Auth::user();
    return view('main', ['products' => $products, 'user' => $user]);
})->name('main')->middleware('auth');


Route::put('/add_product', [ProductsController::class, 'add_product']);
Route::post('/remove_product', [ProductsController::class, 'remove_product']);
Route::post('/edit_product', [ProductsController::class, 'edit_product']);

require __DIR__.'/auth.php';
require __DIR__.'/product.php';
