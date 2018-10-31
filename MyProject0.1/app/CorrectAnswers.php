<?php

namespace App;
use App\Question;
use App\Answer;

use Illuminate\Database\Eloquent\Model;

class CorrectAnswers extends Model
{
      public $table = 'correct_answers';
  protected $fillable = [
      'question_id', 'answer_id', 'body',
  ];

  public function question() {
      return $this->belongsTo('App\Question');
  }
    public function answer() {
      return $this->belongsTo('App\Answer');
  }
}
