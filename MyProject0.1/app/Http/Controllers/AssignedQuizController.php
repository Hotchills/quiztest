<?php

namespace App\Http\Controllers;

use App\AssignedQuiz;
use App\Quiz;
use App\GuestUser;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AssignedQuizController extends Controller {

    function __construct() {

        $this->middleware('auth', ['except' => ['index', 'show', 'finishtest']]);
    }

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

        $validatedData = $request->validate([
            'QuizID' => 'required|not_in:Select quiz',
                //         'name' => 'required|unique:quizzes|max:40|min:3',
                //          'body' => 'max:500',
        ]);
        if (AssignedQuiz::where('quiz_id', $request->QuizID)->where('guestuser_id', $request->guestuserid)->first()) {

            return redirect()->back()->withErrors('Quiz already assigned to this user');
        }

        $assign = new AssignedQuiz();
        $assign->quiz_id = $request->QuizID;
        $assign->guestuser_id = $request->guestuserid;
        $assign->code = str_random(15);
        $assign->grade = 0;
        $assign->time = 30;
        // $assign->assigned_at = date('Y-m-d');
        // $assign->start_at = date('Y-m-d H:i:s');
        $quiz = Quiz::where('id', $assign->quiz_id)->first();
        $guestuser = GuestUser::where('id', $assign->guestuser_id)->first();
        $assign->quiz()->associate($quiz);
        $assign->guestuser()->associate($guestuser);
        $assign->save();

        return redirect()->back()->with('message', 'Quiz added to User');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AssignedQuiz  $assignedQuiz
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request) {
        $temp = $request->code;      
        if ($temp == 'Thisisademocode') {
            return view('/DemoPage');
        }
        if($temp=='demotest')
        {
            return redirect()->to('/Thisisademocode/demotest/StartTestPage')->with('message', 'Good Luck');
            
            
        }
        if ($assignedquiz = AssignedQuiz::where("code", $temp)->first()) {
            $quiz = Quiz::where("id", $assignedquiz->quiz_id)->first();
            if ($assignedquiz->time == 0) {
                return redirect()->to('/LoginUser')->withErrors('Test has been done already');
            }
            // return redirect()->to('/' . $temp . '/' . $quiz->name)->with('message', 'Good Luck');
            return redirect()->to('/' . $temp . '/' . $quiz->name . '/StartTestPage')->with('message', 'Good Luck');
        }
        return redirect()->to('/LoginUser')->withErrors('bad code');
    }

    public function finishtest($code, Request $request) {
        //return redirect()->back()->withErrors('bad input');

        if ($assignedquiz = AssignedQuiz::where("code", $code)->first()) {

            if ($request->closetest) {
                $assignedquiz->time = 0;
                $assignedquiz->save();
                return view('/EndTestPage')->withErrors('Test has been closed');
            }
            if ($assignedquiz->start_at == NULL) {
                return view('/LoginUser')->withErrors('Test not started, please try again');
            } elseif($assignedquiz->time == 0){
             return view('/LoginUser')->withErrors('Test already finished');
            }else{
                $timeleft = Carbon::now()->diffInSeconds($assignedquiz->start_at);
                if ($timeleft / 60 > $assignedquiz->time ) {
                    $assignedquiz->time = 0;
                    $assignedquiz->save();
                    return view('/EndTestPage')->withErrors('Time is up');
                }

            }
        }
        return redirect()->to('/LoginUser')->withErrors('bad code');
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

    public function updatetime(Request $request) {

        if ($assign = AssignedQuiz::where("code", $request->code)->first()) {

            $assign->time = (int) $request->time;
            if ($assign->time == 0 || $assign->time < 0)
                return redirect()->back()->withErrors('bad input');
            $assign->save();
            return redirect()->back()->with('message', 'Done');
        }

        return redirect()->back()->withErrors('can`t save the time');
    }

}
