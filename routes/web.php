<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;

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
    // echo '<pre>'; print_r($products); '</pre>';
    return view('main', compact('products'));
});

Route::put('/add_product', [ProductsController::class, 'add_product']);
