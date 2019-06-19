<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(){

        $user = DB::table('users')->get();

        return view('user_table', ['user' => $user]);
    }
}
