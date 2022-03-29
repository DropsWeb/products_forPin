<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class LoginController extends Controller
{

    public function login() {
        $user = Auth::user();
        return view('login');
    }

    public function register() {
        return view('register');
    }

    public function auth(Request $request) {
        $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);
        $credentials = $request->only('name', 'password');
        if(Auth::attempt($credentials)) {
            return redirect()->intended('/');
        }

        return redirect('login')->withSuccess("Неверный логин или пароль");
    }

    public function logout() {
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }
}
