<?php

namespace App\Http\Controllers;

use App\Quiz;
use App\Question;
use App\User;
use App\Answer;
use Illuminate\Http\Request;

class QuizController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
        return view('CreateQuiz');
    }

    public function startquiz($main) {
        //
        if ($quiz = Quiz::where('name', $main)->first()) {
            $questions = $quiz->question;
            return view('quiz', compact('quiz', 'questions'));
        }
        abort(404);
    }

    public function geteditquiz($main) {
        //
        if ($quiz = Quiz::where('name', $main)->first()) {
            $questions = $quiz->question;
            return view('QuizEdit', compact('quiz', 'questions'));
        }
        abort(404);
    }

    public function Checkquizresult($main, $user) {
        //
        if ($quiz = Quiz::where('name', $main)->first() && $user = User::find(1)) {

            $quiz = Quiz::where('name', $main)->first();
            $questions = Question::where('quiz_id', $quiz->id)->get();


            return view('CheckQuizResult', compact('quiz', 'questions'));
        }
        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validatedData = $request->validate([
            'title' => 'required|unique:quizzes|max:100|min:3',
            'name' => 'required|unique:quizzes|max:40|min:3',
            'body' => 'max:500',
        ]);

        $quiz = new Quiz();
        $quiz->name = $request->name;
        $quiz->title = $request->title;
        $quiz->body = $request->body;
        $quiz->save();

        return redirect()->to('/' . $quiz->name)->with('message', 'Quiz added');
    }

    public function destroy($id) {



        Quiz::destroy($id);

        return redirect()->back()->with('message', 'Quiz has been deleted');
    }

}
