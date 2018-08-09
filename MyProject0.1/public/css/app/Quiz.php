<?php

namespace App;
use App\Question;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
  public $table = 'quizzes';
protected $fillable = [
    'name', 'title', 'body',
];

public function question() {
    return $this->hasMany('App\Question','quiz_id','id');
}

public function QuestionPaginate(){

  $questions=Question::where("quiz_id",$this->id)->paginate(1);

  return $questions;
}

}
