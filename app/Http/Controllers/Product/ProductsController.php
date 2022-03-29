<?php

namespace App\Http\Controllers\Product;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\EditProductRequest;
use App\Services\ProductService;

class ProductsController extends Controller
{

    public function addProduct(ProductRequest $request) {
        return ProductService::add($request->toArray());
    }

    public static function index() {
        return view('main', ProductService::getData());
    }

    public function removeProduct(Request $request) {
        return ProductService::remove($request->id);
    }

    public function editProduct(EditProductRequest $request) {
        return ProductService::edit($request->all());
    }



}
