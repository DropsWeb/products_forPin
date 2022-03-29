<?php

namespace App\Http\Controllers\Product;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;
use App\Jobs\SendEmail;

class ProductsController extends Controller
{

    public function addProduct(Request $request) {
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
        dispatch(new SendEmail());
        return redirect('/');

    }

    public static function getProduct() {
        $products = Products::all();
        $user = Auth::user();
        return view('main', ['products' => $products, 'user' => $user]);
    }

    public function removeProduct(Request $request) {
        $product = Products::find($request->id);
        $product->delete();
        return true;
    }

    public function editProduct(Request $request) {

        $request->validateWithBag('edit', [
            'name' => ['bail', 'required','min:10'],
            'article' => ['bail', 'required', 'regex:/^[A-Za-z0-9]+$/']
        ]);
        $product = Products::find($request->id);

        $user = Auth::user();

        if($product->ARTICLE !== $request->article){
            if(!$user->isAdmin){
                return redirect('/')->withSuccess('Редактировать артикул может только администратор');
            }
        }

        $product->ARTICLE = $request->article;
        $product->NAME = $request->name;
        $product->STATUS = $request->status;
        $product->DATA = json_encode($request->input('data'));
        $product->save();

        return redirect('/');
    }



}
