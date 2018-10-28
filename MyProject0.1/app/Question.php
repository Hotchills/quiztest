<?php

namespace App;

use App\Answer;
use App\UserAnswer;
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

    public function useranswer() {
        return $this->hasMany('App\UserAnswer', 'question_id', 'id');
    }

    public function Answers() {

        $answers = Answer::where("question_id", $this->id)->get();

        return $answers;
    }

    public function UserAnswers($temp) {
        
       if( $answer = UserAnswer::where('question_id', $this->id)->where('user_id',user_id)->where('body',$temp)->first())
               if($answer->body != 0)
        return true;
       
       else
           return false;
    }
        public function UserAnswers2() {
        
        $answers = UserAnswer::where("question_id", $this->id)->where('user_id',1)->get();
        
        return $answers;
    }

}
