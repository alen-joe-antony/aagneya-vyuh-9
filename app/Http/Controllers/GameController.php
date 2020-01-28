<?php

namespace App\Http\Controllers;

use App\Question;
use App\SolvedQuestionStat;
use App\UserLevel;
use App\Meme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;


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
        // if coin != 0
        // coins - 10
        $this->validate($request, [
            'answer'   => 'required|regex:/^[\w\\s]+$/',
        ]);

        $answer = $request->get('answer');
        $answer = Str::upper($answer);

        $level = UserLevel::findOrFail(Auth::user()->username)->current_level;
        $samples = Config::get('proxymeter.levels.'.$level);
        $proximity = array_search($answer, $samples);

        $solved_question = SolvedQuestionStat::whereUsernameAndQuestionNo(Auth::user()->username, $level)->first();
        $attempts = $solved_question->attempts;
        $solved_question->attempts = $attempts + 1;
        $solved_question->save();

        return $proximity;
    }

    function leaderboard() {
        $entry = DB::table('user_levels')->orderBy('user_levels.current_level', 'DESC')->orderBy('user_levels.last_update_time', 'ASC')->get();
        return view('leaderboard', ['entry' => $entry]);
    }
}
