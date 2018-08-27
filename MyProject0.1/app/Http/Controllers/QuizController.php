<?php

namespace App\Http\Controllers;

use App\Quiz;
use App\Question;
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

        return redirect()->back()->with('message', 'Quiz added');
    }

}
