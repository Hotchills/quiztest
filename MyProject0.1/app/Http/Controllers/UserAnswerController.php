<?php

namespace App\Http\Controllers;

use App\UserAnswer;
use App\Question;
use App\User;
use Illuminate\Http\Request;

class UserAnswerController extends Controller {

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
    public function store(Request $request) {
        //save in DB the answer


        $question = Question::find($request->question_id);

        $user = User::find(1);

        $useranswer = new UserAnswer();
        $useranswer->body = $request->useranswer;
        $useranswer->question_id = $question->id;
        $useranswer->user_id = $user->id;
        $useranswer->question()->associate($question);
        $useranswer->user()->associate($user);

        $useranswer->save();

        return redirect()->back()->with('message', $request->question_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserAnswer  $userAnswer
     * @return \Illuminate\Http\Response
     */
    public function show(UserAnswer $userAnswer) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserAnswer  $userAnswer
     * @return \Illuminate\Http\Response
     */
    public function edit(UserAnswer $userAnswer) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserAnswer  $userAnswer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserAnswer $userAnswer) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserAnswer  $userAnswer
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserAnswer $userAnswer) {
        //
    }

}
