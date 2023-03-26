<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function logout(){
        Auth::logout();
        return redirect('/')->with('status', 'You are now logged out!');
    }

    public function showCorrectHomepage(){
        if (Auth::check()) {
            return view('homepage-feed');
        } else {
            return view('homepage');
        }
        
    }

    public function login(Request $request) {
        $incomingFields = $request->validate([
            'loginusername' => 'required',
            'loginpassword' => 'required'
        ]);

        if (Auth::attempt(['username' => $incomingFields['loginusername'], 'password' => $incomingFields['loginpassword']])) {
            $request->session()->regenerate();
            return redirect('/')->with('status', 'You are now logged in!');
        } else {
            return redirect('/')->with('failed', 'Invalid log in');
        }
    }

    public function register(Request $request){
        $incomingFields = $request->validate([
            'username'=>['required', 'min:3', 'max: 20', Rule::unique('users', 'username')],
            'email'=>['required', 'email', Rule::unique('users', 'email')],
            'password'=>['required', 'min:8', 'confirmed']
        ]);

        // $incomingFields ['password'] = bcrypt('password');
        $user = User::create($incomingFields);
        Auth::login($user);
        return redirect('/')->with('success','Youre now registered');
    }
}
