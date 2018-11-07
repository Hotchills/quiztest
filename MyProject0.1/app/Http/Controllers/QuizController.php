<?php

namespace App\Http\Controllers;

use App\Quiz;
use App\Question;
use App\User;
use App\Answer;
use App\GuestUser;
use App\AssignedQuiz;
use App\CorrectAnswers;
use Illuminate\Http\Request;

class QuizController extends Controller {
    
            function __construct()
    {
        
         $this->middleware('auth', ['except' => ['startquiz']]);
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
        return view('CreateQuiz');
    }

    public function startquiz($code, $main) {
        //
        if ($quiz = Quiz::where('name', $main)->first()) {
            $questions = $quiz->question;
            return view('quiz', compact('quiz', 'questions', 'code'));
        }
        abort(404);
    }

    public function showquiz($main) {
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

    public function checkquizresult($code) {
        //
        if ($tempcode = AssignedQuiz::where('code', $code)->first()) {

            $quiz = Quiz::where('id', $tempcode->quiz_id)->first();
            $questions = Question::where('quiz_id', $tempcode->quiz_id)->get();
            return view('CheckQuizResult', compact('quiz', 'questions','code'));
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
