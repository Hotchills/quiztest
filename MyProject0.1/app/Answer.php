<?php

namespace App;
use App\CorrectAnswers;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{

  public $table = 'answers';
  protected $fillable = [
      'question_id', 'aux', 'body',
  ];

  public function question() {
      return $this->belongsTo('App\Question');
  }
      public function correctanswers() {
        return $this->hasOne('App\CorrectAnswers');
    }

        public function Getcorrectanswers() {

        $tmep2 = CorrectAnswers::where('answer_id', $this->id)->first();

        return $tmep2;
    }
}
