<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){

        $user = User::select('role.role_name','users.username', 'users.email', 'users.user_id', 'users.password', 'users.created_at')
            ->join('role','role.role_id','=','users.role_id')
            ->get();

        $role = $this->getRole();

        return view('user_table', [
            'user' => $user,
            'role' => $role,
            ]
        );
    }

    public function getRole()
    {
        return $role = Role::all();
    }

    public function store(Request $request)
    {
        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        return redirect('/user_table');
    }

    public function edit($id)
    {
        $user = User::select('users.*')
            ->join('role','role.role_id','=','users.role_id')
            ->where('user_id',$id)->first();;
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role_id = $request->role_id;
        $user->save();

        return redirect('/tanlong_table');
    }

    public function hapus($id)
    {
        DB::table('users')->where('user_id',$id)->delete();

        return back();
    }
}
