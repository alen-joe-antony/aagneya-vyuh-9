<?php

namespace App\Http\Controllers;

use App\AttemptedAnswer;
use App\Question;
use App\SolvedQuestionStat;
use App\UserLevel;
use App\Meme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;

use App\User;


class GameController extends Controller
{
    function index($mode = 0) {
        $question_revealed = UserLevel::findOrFail(Auth::user()->username)->question_revealed;
        if ($question_revealed == 1) {
            $current_level = UserLevel::findOrFail(Auth::user()->username)->current_level;
            $img_url = Question::findOrFail($current_level)->question_img_url;
            if($mode) {
                return $img_url;
            }
            return view('game')->with('q_img_url', $img_url);
        } else {
            return view('game');
        }
    }

    function getQuestion() {
        UserLevel::where('username', Auth::user()->username)->update(array('question_revealed' => 1));
        $level = UserLevel::findOrFail(Auth::user()->username)->current_level;

        $solved_question = new SolvedQuestionStat();
        $solved_question->username = Auth::user()->username;
        $solved_question->question_no = $level;
        $solved_question->save();
        LogsController::logData('Reveal Question', 'Question #'.$level.' revealed by user');
        return back();
    }

    function submitAnswer(Request $request) {
        if (isset($_POST['submit'])) {
            $data = GameController::validateAnswer($request);
            return view('game')->with('data', $data);
        } else if (isset($_POST['proxymeter'])) {
            $proximity = GameController::proxymeter($request);
            $img_url = GameController::index($mode = 1);
            return view('game')->with('q_img_url', $img_url)->with('proximity', $proximity);
        }
    }

    function validateAnswer(Request $request) {

        $this->validate($request, [
            'answer'   => 'required|regex:/^[\w\\s]+$/',
        ]);

        $level = UserLevel::findOrFail(Auth::user()->username)->current_level;
        $correct_answer = Question::findOrFail($level)->answer;
        $correct_answer = Str::upper($correct_answer);

        $given_answer = $request->get('answer');
        $given_answer = Str::upper($given_answer);

        // Attempts Log

        $attempts = new AttemptedAnswer;
        $attempts->username = Auth::user()->username;
        $attempts->level = $level;
        $attempts->attempt = $given_answer;
        $attempts->mode = "submit";
        $attempts->save();

        LogsController::logData('Submit Answer', $given_answer.' as answer to question #'.$level);

        if($correct_answer == $given_answer) {
            UserLevel::where('username', Auth::user()->username)->update(array('current_level'=> $level + 1));
            UserLevel::where('username', Auth::user()->username)->update(array('question_revealed'=> 0));

            $solved_question = SolvedQuestionStat::whereUsernameAndQuestionNo(Auth::user()->username, $level)->first();
            $attempts = $solved_question->attempts;
            $solved_question->attempts = $attempts + 1;

            $start_time = $solved_question->start_time;
            $finish_time = now();
            $time_taken = $finish_time->diff($start_time)->format('%H:%I:%S');
            $solved_question->finish_time = $finish_time;
            $solved_question->time_taken = $time_taken;
            $solved_question->save();


            UserLevel::where('username', Auth::user()->username)->update(array('last_update_time' => $finish_time));

            $coins = UserLevel::findOrFail(Auth::user()->username)->coins;
            UserLevel::where('username', Auth::user()->username)->update(array('coins' => $coins + 25));

            $meme_url = Meme::where('class', 'correct')->get()->random()->url;
            return ['url' => $meme_url, 'answer' => 'correct'];
        }
        else {
            $solved_question = SolvedQuestionStat::whereUsernameAndQuestionNo(Auth::user()->username, $level)->first();
            $attempts = $solved_question->attempts;
            $solved_question->attempts = $attempts + 1;
            $solved_question->save();

            $meme_url = Meme::where('class', 'wrong')->get()->random()->url;
            return ['url' => $meme_url, 'answer' => 'wrong'];
        }
    }

    function proxymeter(Request $request) {
        $coins = UserLevel::findOrFail(Auth::user()->username)->coins;
        $answer = $request->get('answer');
        $answer = Str::upper($answer);

        $level = UserLevel::findOrFail(Auth::user()->username)->current_level;

         // Attempts Log

         $attempts = new AttemptedAnswer;
         $attempts->username = Auth::user()->username;
         $attempts->level = $level;
         $attempts->attempt = $answer;
         $attempts->mode = "proxymeter";

         LogsController::logData('Proxymeter', $answer.' as proxymeter input to question #'.$level);

         if($coins > 0) {
            $attempts->proxymeter_state = "enabled";
         }
         else {
            $attempts->proxymeter_state = "disabled";
         }
         $attempts->save();

        if($coins > 0) {
            $this->validate($request, [
                'answer'   => 'required|regex:/^[\w\\s]+$/',
            ]);

            $samples = Config::get('proxymeter.levels.'.$level);
            $proximity = array_search($answer, $samples);

            $solved_question = SolvedQuestionStat::whereUsernameAndQuestionNo(Auth::user()->username, $level)->first();
            $attempts = $solved_question->attempts;
            $solved_question->attempts = $attempts + 1;
            $solved_question->save();

            UserLevel::where('username', Auth::user()->username)->update(array('coins' => $coins - 10));

            return ['proximity' => $proximity];
        }
        else {
            return ['proximity_error' => 'ERROR : Out of coins'];
        }
    }

    function leaderboard() {
        $user_type =  User::where('username', Auth::user()->username)->first()->user_type;
        if($user_type == 'player') {
            $entry = DB::table('users')
            ->join('user_levels', 'users.username', '=', 'user_levels.username')
            ->whereUserType('player')->orderBy('user_levels.current_level', 'DESC')->orderBy('user_levels.last_update_time', 'ASC')->get();
            return view('leaderboard', ['entry' => $entry]);
        }
        elseif($user_type == 'tester') {
            $entry = DB::table('users')
            ->join('user_levels', 'users.username', '=', 'user_levels.username')
            ->whereUserType('tester')->orderBy('user_levels.current_level', 'DESC')->orderBy('user_levels.last_update_time', 'ASC')->get();
            return view('leaderboard', ['entry' => $entry]);
        }
        elseif($user_type == 'admin') {
            $entry = DB::table('users')
            ->join('user_levels', 'users.username', '=', 'user_levels.username')
            ->whereUserType('player')->orderBy('user_levels.current_level', 'DESC')->orderBy('user_levels.last_update_time', 'ASC')->get();

            $entry1 = DB::table('users')
            ->join('user_levels', 'users.username', '=', 'user_levels.username')
            ->whereUserType('tester')->orderBy('user_levels.current_level', 'DESC')->orderBy('user_levels.last_update_time', 'ASC')->get();

            return view('leaderboard', ['admin' => True, 'entry' => $entry, 'entry1' => $entry1]);
        }
    }

    function getCoins() {
        $coins = UserLevel::findOrFail(Auth::user()->username)->coins;
        return $coins;
    }

    function viewProfile() {
        $user_entry = DB::table('users')->where('username', Auth::user()->username)->first();
        $user_level_entry = DB::table('user_levels')->where('username', Auth::user()->username)->first();
        $solved_question_entry = DB::table('solved_question_stats')->where('username', Auth::user()->username)->get();
        $attempted_answers = DB::table('attempted_answers')->where('username', Auth::user()->username)->get();
        return view('profile', ['user_entry' => $user_entry, 'user_level_entry' => $user_level_entry, 'solved_question_entry' => $solved_question_entry, 'attempted_answers' => $attempted_answers]);
    }
}
