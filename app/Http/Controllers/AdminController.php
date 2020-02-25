<?php

namespace App\Http\Controllers;

use App\User;
use App\UserLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    function index() {
        $user_type = User::where('username', Auth::user()->username)->first()->user_type;
        $entry = DB::table('users')
            ->join('user_levels', 'users.username', '=', 'user_levels.username')
            ->select('users.name', 'users.username', 'users.user_type', 'users.status', 'user_levels.current_level', 'user_levels.coins')
            ->get();
        return view('admin', ['entry' => $entry]);
    }

    function viewProfile($username) {
        $user_entry = DB::table('users')->where('username', $username)->first();
        $user_level_entry = DB::table('user_levels')->where('username', $username)->first();
        $solved_question_entry = DB::table('solved_question_stats')->where('username', $username)->get();
        $attempted_answers = DB::table('attempted_answers')->where('username', $username)->get();
        return view('profile', ['admin' => True, 'user_entry' => $user_entry, 'user_level_entry' => $user_level_entry, 'solved_question_entry' => $solved_question_entry, 'attempted_answers' => $attempted_answers]);
    }

    function coinsGiveaway($username, Request $request) {
        $user_level = UserLevel::where('username', $username)->first();
        $coins = $user_level->coins;
        $coins_inc = $request->get('num_coins');
        $user_level->update(array('coins' => $coins + $coins_inc));
        return back();
    }

    function coinsGiveawayAll(Request $request) {
        $coins_inc = $request->get('num_coins');
        $user_level = UserLevel::query()->get();
        foreach($user_level as $row) {
            $coins = $row->coins;
            $row->coins = $coins + $coins_inc;
            $row->save();
        }
        return back();
    }

    function changeUserType($username, Request $request) {
        if($username != Auth::user()->username) {
            $user_type = $request->get('user_type');
            User::where('username', $username)->first()->update(array('user_type' => $user_type));
            return back();
        }
        else {
            return "<h1>Cannot change user type associated with the current admin account <br> Login as another admin and try again </h1>";
        }
    }

    function blockUser($username) {
        $status = User::where('username', $username)->first()->status;
        if ($status == "active") {
            User::where('username', $username)->first()->update(array('status' => 'blocked'));
        }
        elseif ($status == "blocked") {
            User::where('username', $username)->first()->update(array('status' => 'active'));
        }
        return back();
    }
}
