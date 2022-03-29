<?php

namespace App\Services;

use App\Models\Products;
use Illuminate\Support\Facades\Auth;
use App\Jobs\SendEmail;


class ProductService {
    public static function getData() {
        $products = Products::all();
        $user = Auth::user();
        return [
            'products' => $products,
            'user' => $user
        ];
    }

    public static function add($data) {
        Products::create($data);
        dispatch(new SendEmail());
        return redirect('/');
    }

    public static function remove($data) {
        $product = Products::find($data);
        $product->delete();
        return true;
    }

    public static function edit($data) {
        $product = Products::find($data['id']);

        $user = Auth::user();

        if($product->ARTICLE !== $data['article']){
            if(!$user->isAdmin){
                return redirect('/')->withSuccess('Редактировать артикул может только администратор');
            }
        }

        $product->article = $data['article'];
        $product->name = $data['name'];
        $product->status = $data['status'];
        $product->data = $data['data'];
        $product->save();

        return redirect('/');
    }

}
