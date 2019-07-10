<?php

namespace App\Http\Controllers;

use App\Quiz;
use App\Question;
use App\User;
use App\Answer;
use App\GuestUser;
use App\AssignedQuiz;
use App\CorrectAnswers;
use App\UserAnswer;
use Illuminate\Http\Request;
use Carbon\Carbon;

class QuizController extends Controller {

    function __construct() {

        $this->middleware('auth', ['except' => ['startquiz', 'starttestpage']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
        return view('CreateQuiz');
    }

    public function startquiz($code, $main) {
        //        


        if ($quiz = Quiz::where('name', $main)->first()) {
            $questions = $quiz->question;
            $assign = AssignedQuiz::where("code", $code)->first();

            if ($assign->start_at == NULL) {
                $assign->start_at = Carbon::now();
                $assign->save();
            }
            $timeleft = Carbon::now()->diffInSeconds($assign->start_at);
            //   $timeleft = gmdate("H:i:s", $timeleft);
            //   $timeleft = $timeleft/60;
            if ($timeleft == 86399)
                $timeleft = 1;

            //  return redirect()->back()->with('message', $timeleft);
            if ($timeleft / 60 > $assign->time || $assign->time == 0) {
                return redirect()->to('/' . $code . '/FinishTest');
            } else
                return view('quiz', compact('quiz', 'questions', 'code', 'timeleft'));
        }
        abort(404);
    }

    public function starttestpage($code, $main) {
        if ($code == 'Thisisademocode' && $main = 'demotest') {
            $assign = AssignedQuiz::where("code", $code)->first();
            $assign->start_at = NULL;
            $assign->time=30;
            $assign->save(); 
            $useranswers= UserAnswer::where('user_id',$assign->guestuser_id)->delete();
        }

        if ($quiz = Quiz::where('name', $main)->first()) {
            $questions = $quiz->question;

            $assign = AssignedQuiz::where("code", $code)->first();
            if ($assign->time == 0) {
                return redirect()->to('/' . $code . '/FinishTest');
            }
            return view('StartTestPage', compact('quiz', 'code'));
        }
        abort(404);
    }

    public function showquiz($main) {
        //
        if ($quiz = Quiz::where('name', $main)->first()) {
            $questions = $quiz->question;
            return view('quiz', compact('quiz', 'questions'));
        }
        abort(404);
    }

    public function geteditquiz($main) {
        //
        if ($quiz = Quiz::where('name', $main)->first()) {
            $questions = $quiz->question;
            return view('QuizEdit', compact('quiz', 'questions'));
        }
        abort(404);
    }

    public function checkquizresult($code) {
        //
        if ($tempcode = AssignedQuiz::where('code', $code)->first()) {

            $quiz = Quiz::where('id', $tempcode->quiz_id)->first();
            $questions = Question::where('quiz_id', $tempcode->quiz_id)->get();
            return view('CheckQuizResult', compact('quiz', 'questions', 'code'));
        }
        abort(404);
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
            'title' => 'required|unique:quizzes|max:100|min:3',
            'name' => 'required|alpha_num|unique:quizzes|max:40|min:3',
            'body' => 'max:500',
        ]);
        $quiz = new Quiz();
        $quiz->name = preg_replace('/[\x00-\x1F\x7F\xA0]/u', '', $request->name);
        $quiz->title = $request->title;
        $quiz->body = $request->body;
        $quiz->save();

        return redirect()->to('/' . $quiz->name)->with('message', 'Quiz added');
    }

    public function destroy($id) {

        Quiz::destroy($id);

        return redirect()->back()->with('message', 'Quiz has been deleted');
    }
    
     public function update(Request $request) {
 
        if(Quiz::where('id',$request->quizID)->update(['body'=>$request->quizBODY]))
  
        return redirect()->back()->with('message', 'Quiz edited'); 
        else          
         return redirect()->back()->withErrors('Bad quiz ID');
        }

}
