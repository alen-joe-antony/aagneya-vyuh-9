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

    function viewProfile($username) {
        $user_entry = DB::table('users')->where('username', $username)->first();
        $user_level_entry = DB::table('user_levels')->where('username', $username)->first();
        $solved_question_entry = DB::table('solved_question_stats')->where('username', $username)->get();

        return view('profile', ['admin' => True, 'user_entry' => $user_entry, 'user_level_entry' => $user_level_entry, 'solved_question_entry' => $solved_question_entry]);
    }
}
