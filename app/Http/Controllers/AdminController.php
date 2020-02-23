<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    function index() {
        $user_type = User::where('username', Auth::user()->username)->first()->user_type;
        if($user_type == 'admin') {
            $entry = DB::table('users')
            ->join('user_levels', 'users.username', '=', 'user_levels.username')
            ->select('users.name', 'users.username', 'users.user_type', 'users.status', 'user_levels.current_level', 'user_levels.coins')
            ->get();
            return view('admin', ['entry' => $entry]);
        }
        else {
            return "<h1>Sorry, you have no clearance !</h1>";
        }
    }
}
