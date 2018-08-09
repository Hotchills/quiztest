<?php

namespace App\Http\Controllers;

use App\Question;
use App\Quiz;
use App\Answer;
use App\Http\Controllers\Session;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($main)
    {
      $quiztempid= Quiz::where('name', $main)->first()->id;
            return view('/CreateQuestion', compact('quiztempid'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      $validatedData = $request->validate([
      'title' => 'required|unique:quizzes|max:100|min:3',
      'body' => 'max:500',
      ]);

      $quiz = Quiz::where('id', $request->id)->first();
      $answer =$request->answer;
      $question = new Question();
      $question->title = $request->title;
      $question->body = $request->body;
      $question->quiz_id=$request->id;
      $question->question_nr=0;
      $question->save();

      $question->quiz()->associate($quiz);



      return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
    }
}
