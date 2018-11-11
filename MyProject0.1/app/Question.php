<?php

namespace App;

use App\Answer;
use App\UserAnswer;
use App\AssignedQuiz;
use App\CorrectAnswers;
use Illuminate\Database\Eloquent\Model;

class Question extends Model {

    public $table = 'questions';
    protected $fillable = [
        'question_nr', 'type', 'body', 'quiz_id',
    ];

    public function quiz() {
        return $this->belongsTo('App\Quiz', 'quiz_id', 'id');
    }

    public function answer() {
        return $this->hasMany('App\Answer');
    }

    public function correctanswers() {
        return $this->hasMany('App\CorrectAnswers');
    }

    public function useranswer() {
        return $this->hasMany('App\UserAnswer', 'question_id', 'id');
    }

    public function Answers() {

        $answers = Answer::where("question_id", $this->id)->get();

        return $answers;
    }

    public function UserAnswers($temp, $code) {

        if ($userid = AssignedQuiz::where('code', $code)->first())
            if ($answer = UserAnswer::where('question_id', $this->id)->where('user_id', $userid->guestuser_id)->where('body', $temp)->first())
                if ($answer->body != 0)
                    return true;


        return false;
    }

    public function CompareUserAnswer($temp, $code) {

        if ($user = AssignedQuiz::where('code', $code)->first())
            if( $answer = UserAnswer::where("question_id", $this->id)->where('user_id', $user->guestuser_id)->where('body',$temp)->first())
                 return $answer;
        return false;
    }

    public function Getcorrectanswers() {

        $tmep2 = CorrectAnswers::where('question_id', $this->id)->first();

        return $tmep2;
    }

}
