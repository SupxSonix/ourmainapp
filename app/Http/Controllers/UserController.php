<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function login(Request $request) {
        $incomingFields = $request->validate([
            'loginusername' => 'required',
            'loginpassword' => 'required'
        ]);

        if (Auth::attempt(['username' => $incomingFields['loginusername'], 'password' => $incomingFields['loginpassword']])) {
            $request->session()->regenerate();
            return 'Congrats!!!';
        } else {
            return 'Sorry!!!';
        }
    }

    public function register(Request $request){
        $incomingFields = $request->validate([
            'username'=>['required', 'min:3', 'max: 20', Rule::unique('users', 'username')],
            'email'=>['required', 'email', Rule::unique('users', 'email')],
            'password'=>['required', 'min:8', 'confirmed']
        ]);

        $incomingFields ['password'] = bcrypt('password');
        User::create($incomingFields);
        return 'Hello from register function';
    }
}
