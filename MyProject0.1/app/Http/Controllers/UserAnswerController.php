<?php

namespace App\Http\Controllers;

use App\UserAnswer;
use App\Question;
use App\User;
use App\Answer;
use App\Quiz;
use App\GuestUser;
use App\AssignedQuiz;
use App\CorrectAnswers;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

        /**
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
         * */
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
                    $user = GuestUser::find(1);
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
 */
    public function addajaxanswer(Request $request) {

        $answerid = $request->answerid;

        $questionid = $request->questionid;

        $quizcode = $request->quizcode;

        if ($useridtemp = AssignedQuiz::where('code', $quizcode)->first()) {
             $timeleft = Carbon::now()->diffInSeconds($useridtemp->start_at);
            if($timeleft / 60 < $useridtemp->time && $useridtemp->time != 0){

            $userid = $useridtemp->guestuser_id;
            // return response()->json(['status' => $userid], 201);

            if ($tempUser = UserAnswer::where('user_id', $userid)->where('question_id', $questionid)->where('body', $answerid)->first()) {

                $tempUser->body = 0;
                $tempUser->save();
            } elseif ($tempUser = UserAnswer::where('user_id', $userid)->where('question_id', $questionid)->where('body', 0)->first()) {

                $tempUser->body = $answerid;
                $tempUser->save();
            } else {
                $tempUser = new UserAnswer;
                $tempUser->body = $answerid;
                $tempUser->question_id = $questionid;
                $tempUser->user_id = $userid;
                $user = GuestUser::where('id', $userid)->first();
                $question = Question::find($questionid);
                $tempUser->save();
                $tempUser->guestuser()->associate($user);
                $tempUser->question()->associate($question);
            }
            //calculate grade on assignedquiz
            $quiz = Quiz::find($useridtemp->quiz_id);
            $question = Question::where('quiz_id', $useridtemp->quiz_id)->get();
            $totalq = $question->count();
            $gradearray = [];
            for ($i = 0; $i < $totalq; $i++) {
                $totalans = 0;
                $tempgrade = 0;
                $answer = Answer::where('question_id', $question[$i]->id)->get();
                $totalans = $answer->count();
                for ($j = 0; $j < $totalans; $j++) {
                    if ($array = CorrectAnswers::where('answer_id', $answer[$j]->id)->get()->count() > 0) {
                        if ($array2 = UserAnswer::where('question_id', $question[$i]->id)->where('user_id', $userid)->where('body', $answer[$j]->id)->get()->count()) {
                            $tempgrade = 3;
                            //  return response()->json(['grade' => $array]);
                        } else {
                            $tempgrade = -1;
                            $j = $totalans;
                        }
                    } elseif ($array2 = UserAnswer::where('question_id', $question[$i]->id)->where('user_id', $userid)->where('body', $answer[$j]->id)->get()->count()) {
                        $tempgrade = -2;
                        $j = $totalans;
                    }
                }
                $gradearray[$i] = $tempgrade;
            }
            // return response()->json([ 'grade' => $gradearray]);
            $tempgrade = 0;
            for ($i = 0; $i < $totalq; $i++) {
                if ($gradearray[$i] >= 0)
                    $tempgrade = $tempgrade + 1;
            }

            $useridtemp->grade = floor($tempgrade/$totalq * 100);
            $useridtemp->save();

            return response()->json(['answer' => $tempUser->body, 'questionid' => $questionid, 'userid' => $userid, 'grade' => $useridtemp->grade]);
            }
            } 

            return response()->json(['answer' => 'fail'], 201);
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
