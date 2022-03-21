<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;

class ProductsController extends Controller
{

    public function add_product(Request $request) {
        $product = new Products;

        $product->ARTICLE = $request->article;
        $product->NAME = $request->name;
        $product->STATUS = $request->status;
        $product->DATA = json_encode($request->input('data'));

        $product->save();
    }

    public function get_product() {
        $products = Products::all();
        foreach($product as $product){
            echo '<pre>'; print_r($product::all()); '</pre>';
        }
    }

}
