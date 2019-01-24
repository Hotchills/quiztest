<?php

namespace App\Http\Controllers;

use App\Play;
use App\Question;
use Illuminate\Http\Request;

class PlayController extends Controller
{
        function __construct() {
        $this->middleware('auth', ['except' => ['index', 'saveplay','demo']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($question_id)
    {
        $question = Question::where('id',$question_id)->first();
        //return view('/CreateQuestion', compact('quiztempid', 'quizname'));
        return view('/QuestionPlay',compact('question'));
        
       
    }
        public function demo()
    {
       // $question = Question::where('id',$question_id)->first();
        //return view('/CreateQuestion', compact('quiztempid', 'quizname'));
        return view('/DemoPage');
        
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function resultsplay($question_id)
    {
        //
        $question = Question::where('id',$question_id)->first();
        $plays=Play::where('question_id',$question_id)->get();
        return view('/QuestionPlayResults',compact('question','plays'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Play  $play
     * @return \Illuminate\Http\Response
     */
    public function saveplay(Request $request)
    {
        //       
     $validatedData = $request->validate([   
            'name' => 'required|max:60|min:3',
            'body' => 'max:5000',
        ]);

        $question = Question::where('id',$request->questionid)->first();
        $play = new Play(); 
        $play->name = $request->name;
        $play->answer = 0;
        $play->info_string = $request->result;
        $play->body = $request->body;
        $play->question_id = $request->questionid;        
        $play->question()->associate($question); 
        $play->save();
        
       return redirect()->to('/ThisIsJustALink/' . $question->id )->with('message', 'Saved');
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Play  $play
     * @return \Illuminate\Http\Response
     */
    public function edit(Play $play)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Play  $play
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Play $play)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Play  $play
     * @return \Illuminate\Http\Response
     */
    public function destroy(Play $play)
    {
        //
    }
}
