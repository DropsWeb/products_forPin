<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\AuthService;
use App\Http\Requests\AuthRequest;


class LoginController extends Controller
{

    public function login() {
        $user = Auth::user();
        return view('login');
    }

    public function register() {
        return view('register');
    }

    public function auth(AuthRequest $request) {
        return AuthService::authLogic($request->only('name', 'password'));
    }

    public function logout() {
        return AuthService::logout();
    }
}
