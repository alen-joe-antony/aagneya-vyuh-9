<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Log;
use App\User;
use Illuminate\Support\Facades\DB;

class LogsController extends Controller
{
    function index() {
        $logs = DB::table('logs')->get();
        return view('logs')->with('logs', $logs);
    }

    static function logData($action, $description) {
        $user = User::where('username', Auth::user()->username)->first();
        Log::create([
            'ip'                    =>      request()->ip(),
            'username'              =>      $user->username,
            'name'                  =>      $user->name,
            'user_type'             =>      $user->user_type,
            'action_type'           =>      $action,
            'action_description'    =>      $description
        ]);
    }
}
