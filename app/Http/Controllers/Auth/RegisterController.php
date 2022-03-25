<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class RegisterController extends Controller
{

    public function newUser(Request $request) {
        $request->validate([
            'name' => ['unique:users', 'min:5', 'required'],
            'email' => ['required', 'email',  'unique:users'],
            'password' => ['required', 'min:5']
        ]);

        $data = $request->all();
        $check = $this->create($data);

        return redirect('login');
    }

    public function create($data) {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'isAdmin' => (isset($data['isAdmin'])) ? $data['isAdmin'] : null,
        ]);
    }
}
