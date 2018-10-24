<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use App\Quiz;
use Illuminate\Http\Request;

class AnswerController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($question) {
        //
        $question = Question::where('id', $question)->first();
        $quizname = Quiz::find($question->quiz_id)->name;
        return view('AddAnswersToQuestion', compact('question', 'quizname'));
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

        //Create new answer , keywords.    
        $question = Question::find($request->question_id);

        $answer = new Answer();
        $answer->body = $request->saveanswer;
        $answer->aux = 0;
        $answer->question_id = $question->id;
        $answer->question()->associate($question); // associate the answer to the question
        $answer->save(); // save answer in DB

        return redirect()->back()->with('message', 'Answer added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Answer $answer) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Answer $answer) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $answer = Answer::where('id', $id)->first();

        $question = Question::where('id', $answer->question_id)->first();
        $question->question_nr = 0;
        $question->save();

        Answer::destroy($id);

        return redirect()->back()->with('message', 'Answer del');
    }

}
