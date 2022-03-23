<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;

class ProductsController extends Controller
{

    public function add_product(Request $request) {

        $request->validateWithBag('add', [
            'name' => ['bail', 'required','min:10'],
            'article' => ['bail', 'required', 'unique:App\Models\Products,ARTICLE', 'regex:/^[A-Za-z0-9]+$/']
        ]);

        $product = new Products;

        $product->ARTICLE = $request->article;
        $product->NAME = $request->name;
        $product->STATUS = $request->status;
        $product->DATA = json_encode($request->input('data'));

        $product->save();
        return redirect('/');

    }

    public static function get_product() {
        // return Products::all()->where("STATUS", 'available')->sortByDesc('id');
        return Products::statusAvailable();
    }

    public function remove_product(Request $request) {
        $product = Products::find($request->id);
        $product->delete();
        return true;
    }

    public function edit_product(Request $request) {
        $product = Products::find($request->id);
        $product->ARTICLE = $request->article;
        $product->NAME = $request->name;
        $product->STATUS = $request->status;
        $product->DATA = json_encode($request->input('data'));
        $product->save();

        return redirect('/');
    }



}