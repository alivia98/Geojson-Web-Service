<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function getLogin()
    {
        return view('login');
    }

    public function postLogin(Request $request)
    {
        if (!auth()->attempt(['username' => $request->username, 'password' => $request->password])){
            return redirect()->back();
        }
        return redirect()->route('home');
    }

    public function getRegister()
    {
        return view('register');
    }

    public function postRegister(Request $request)
    {
        $this->validate($request,[
           'username' => 'required|min:4|unique:users',
           'email' => 'required|email|unique:users',
           'password' => 'required|min:6|confirmed'
        ]);

        $user = User::create([
            'username' => $request->username,
            'email'=> $request->email,
            'password'=> bcrypt($request->password)
        ]);

        auth()->loginUsingId($user->id);

        return redirect()->back();
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('login');
    }
}
