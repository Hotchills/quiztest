<?php

namespace App\Http\Controllers;

use App\AssignedQuiz;
use App\Quiz;
use App\GuestUser;
use Illuminate\Http\Request;

class AssignedQuizController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
    return view('LoginUser');
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

        $Assigne = new AssignedQuiz();
        $Assigne->quiz_id = $request->QuizID;
        $Assigne->guestuser_id = $request->guestuserid;
        $Assigne->code = str_random(15);
        $Assigne->grade = 0;
        $Assigne->time = 0;
        $Assigne->start_at = date('Y-m-d H:i:s');
        $quiz = Quiz::where('id', $Assigne->quiz_id)->first();
        $guestuser = GuestUser::where('id', $Assigne->guestuser_id)->first();
        $Assigne->quiz()->associate($quiz);
        $Assigne->guestuser()->associate($guestuser);
        $Assigne->save();
          return redirect()->back()->with('message', 'Quiz added to User');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AssignedQuiz  $assignedQuiz
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request) {
             $temp=$request->code;
        $assignedquiz=AssignedQuiz::where("code",$temp)->first();
        $quiz=Quiz::where("id",$assignedquiz->quiz_id)->first();
        
       // return redirect()->back()->with('message', $quiz->name);
        return redirect()->to('/' . $quiz->name)->with('message', 'Good Luck');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AssignedQuiz  $assignedQuiz
     * @return \Illuminate\Http\Response
     */
    public function edit(AssignedQuiz $assignedQuiz) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AssignedQuiz  $assignedQuiz
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AssignedQuiz $assignedQuiz) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AssignedQuiz  $assignedQuiz
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssignedQuiz $assignedQuiz) {
        //
    }

}
