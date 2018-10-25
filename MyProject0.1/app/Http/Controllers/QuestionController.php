<?php

namespace App\Http\Controllers;

use App\Question;
use App\Quiz;
use App\Answer;
use Illuminate\Http\Request;

class QuestionController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($main) {
        $quiztempid = Quiz::where('name', $main)->first()->id;
        $quizname = Quiz::where('name', $main)->first()->name;
        return view('/CreateQuestion', compact('quiztempid', 'quizname'));
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

        //    $validatedData = $request->validate([
        //   'type' => 'required|unique:quizzes|max:100|min:3',
        //     'body' => 'required|unique:quizzes|max:500|min:3',
        //    ]);
//Find the quiz in the DB where to put the questions
        $quiz = Quiz::where('id', $request->id)->first();

//Create new question and save all data received from the FORM in CreateQuestion.blade.php   
        $question = new Question();
        $question->type = $request->type;
        $question->body = $request->body;
        $question->quiz_id = $request->id;
        $question->question_nr = $request->mode;
        $question->duplicate = 0;
        $question->quiz()->associate($quiz); // associate the question to the quiz
        $question->save(); // save quiestion in DB
  
        return redirect(route('addanswerstoquestion', ['question' => $question->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request) {

        $question = Question::where('id', $id)->first();
        $question->question_nr = $request->answerid;
        $question->save();
        return redirect()->back()->with('message', 'Correct answer added');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

     
      
        Question::destroy($id);

        return redirect()->back()->with('message', 'Question has been deleted');
    }

}
