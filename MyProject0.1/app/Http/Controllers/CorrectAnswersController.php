<?php

namespace App\Http\Controllers;

use App\CorrectAnswers;
use Illuminate\Http\Request;
use App\Answer;
use App\Question;

class CorrectAnswersController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
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
    public function store($id, Request $request) {
        $question = Question::where('id', $id)->first();
        if ($question->question_nr == NULL)
            $question->question_nr = 1;
        else
            $question->question_nr = $question->question_nr + 1;
$question->save();
        $answer = Answer::where('id', $request->answerid)->first();
        $correctanswer = new CorrectAnswers();
        $correctanswer->question_id = $id;
        $correctanswer->body = 0;
        $correctanswer->answer_id = $request->answerid;
        $correctanswer->question()->associate($question); // associate the question to the quiz
        $correctanswer->answer()->associate($answer); // associate the question to the quiz
        $correctanswer->save();
        return redirect()->back()->with('message', 'Correct answer added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CorrectAnswers  $correctAnswers
     * @return \Illuminate\Http\Response
     */
    public function show(CorrectAnswers $correctAnswers) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CorrectAnswers  $correctAnswers
     * @return \Illuminate\Http\Response
     */
    public function edit(CorrectAnswers $correctAnswers) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CorrectAnswers  $correctAnswers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CorrectAnswers $correctAnswers) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CorrectAnswers  $correctAnswers
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request) {
        
         $question = Question::where('id',$request->questionid)->first();
        if ($question->question_nr == NULL)
            $question->question_nr = 0;
        else
            $question->question_nr = $question->question_nr-1;
        
        $question->save();
        CorrectAnswers::destroy($id);

        return redirect()->back()->with('message', 'CorrectAnswer removed');
    }

}
