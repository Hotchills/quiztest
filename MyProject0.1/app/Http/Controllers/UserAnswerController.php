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
    public function update(Request $request, $id) {
        //
        //       $answer = $request->get('answers');
        $temp = 0;
        if ($tempUsers = UserAnswer::where('user_id', 1)->where('question_id', $id)->get()) {
            foreach ($tempUsers as $tempuser) {
                //    UserAnswer::destroy($tempuser->id);
                $tempuser->body = 0;
                $tempuser->save();
                $temp++;
            }
        }
        if ($request->has('answers')) {
            foreach ($request->input('answers') as $value) {
                if ($temp > 0) {
                    $tempUsers = UserAnswer::where('user_id', 1)->where('question_id', $id)->get();
                    $temp--;
                    $tempUsers[$temp]->body = $value;
                    $tempUsers[$temp]->save();
                } else {
                    $tempUser = new UserAnswer;
                    $tempUser->body = $value;
                    $tempUser->question_id = $id;
                    $tempUser->user_id = 1;
                    $tempUser->save();
                    $user = User::find(1);
                    $question = Question::find($id);
                    $tempUser->user()->associate($user);
                    $tempUser->question()->associate($question);
                }
            }
        } else {
            if ($tempUsers = UserAnswer::where('user_id', 1)->where('question_id', $id)->get()) {
                foreach ($tempUsers as $tempuser) {
                    //    UserAnswer::destroy($tempuser->id);
                    $tempuser->body = 0;
                    $tempuser->save();
                }
            }
        }
        return redirect()->back()->with('message', 'Saved');
    }

    public function addajaxanswer(Request $request) {

        $useranswerid = $request->useranswerid;
        $questionid = $request->questionid;
        //$user = Auth::user();
        if ($tempUser = UserAnswer::where('user_id', 1)->where('question_id', $questionid)->where('body', $useranswerid)->first()) {

            $tempUser->body = 0;
            $tempUser->save();
            
        } elseif ($tempUser = UserAnswer::where('user_id', 1)->where('question_id', $questionid)->where('body', 0)->first()) {

            $tempUser->body = $useranswerid;
            $tempUser->save();
            
        } else {

            $tempUser = new UserAnswer;
            $tempUser->body = $useranswerid;
            $tempUser->question_id = $questionid;
            $tempUser->user_id = 1;
            $tempUser->save();
            $user = User::find(1);
            $question = Question::find($questionid);
            $tempUser->user()->associate($user);
            $tempUser->question()->associate($question);
        }

        //    return response()->json(['status' => 'success'], 201);
        return response()->json(['useranswer' => $tempUser->body, 'questionid' => $questionid]);
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
