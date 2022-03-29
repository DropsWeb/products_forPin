<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Hash;
use Session;

class AuthService {
    public static function goPageLogin(){
        $user = Auth::user();
        return view('login');
    }

    public static function authLogic($credentials) {
        if(Auth::attempt($credentials)) {
            return redirect()->intended('/');
        }
        return redirect('login')->withSuccess("Неверный логин или пароль");
    }

    public static function logout() {
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }

    public static function createUser($data) {
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'isAdmin' => (isset($data['isAdmin'])) ? $data['isAdmin'] : null,
        ]);
        return redirect('login');
    }

}

