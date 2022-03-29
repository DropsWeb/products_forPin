<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Product\ProductsController;
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

Route::put('/add_product', [ProductsController::class, 'addProduct'])->middleware('auth');
Route::post('/remove_product', [ProductsController::class, 'removeProduct'])->middleware('auth');
Route::post('/edit_product', [ProductsController::class, 'editProduct'])->middleware('auth');

