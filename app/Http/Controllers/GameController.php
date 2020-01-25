<?php

namespace App\Http\Controllers;

use App\Question;
use App\SolvedQuestionStat;
use App\UserLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class GameController extends Controller
{
    function index() {
        $question_revealed = UserLevel::findOrFail(Auth::user()->username)->question_revealed;
        if ($question_revealed == 1) {
            $current_level = UserLevel::findOrFail(Auth::user()->username)->current_level;
            $img_url = Question::findOrFail($current_level)->question_img_url;
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
            GameController::proxymeter($request);
        }
    }

    function validateAnswer(Request $request) {

    }

    function proxymeter(Request $request) {

    }
}
