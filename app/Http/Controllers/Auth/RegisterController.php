<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserDataRequest;
use App\Services\AuthService;

class RegisterController extends Controller
{
    public function makeUser(UserDataRequest $request) {
        return AuthService::createUser($request->all());
    }
}
