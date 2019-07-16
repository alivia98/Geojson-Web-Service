<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
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
        $validator = auth()->attempt(['username' => $request->username, 'password' => $request->password]);
        if (!$validator){
            return redirect()->back();
        }
        return redirect()->route('home');
    }

    public function apiLogin(Request $request)
    {
        $Username = $request->input('username');
        $Password = $request->password;
        $Validate = User::where('username', $Username)->first();

        if (is_null($Validate)){
            $params = [
                'succcess' => false,
                'response_code' => 400,
                'message' => 'Username not found',
            ];
            return response()->json($params, 400);
        }

        if(Hash::check($Password, $Validate->password)) {
            $params = [
                'succcess' => true,
                'response_code' => 200,
                'meesage' => 'Login Success'
            ];
            return response()->json($params, 200);
        }

        $params = [
            'succcess' => false,
            'response_code' => 500,
            'meesage' => 'Login Failed'
        ];
        return response()->json($params, 500);
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
            'password'=> Hash::make($request->password)
        ]);

        auth()->loginUsingId($user->user_id);

        return redirect()->back();
    }

    public function logout()
    {
        auth()->logout();

        return redirect('login')->with('alert','Kamu sudah logout');
    }
}
