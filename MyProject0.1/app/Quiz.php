<?php

namespace App;
use App\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Quiz extends Model
{
  public $table = 'quizzes';
protected $fillable = [
    'name', 'title', 'body',
];

public function question() {
    return $this->hasMany('App\Question','quiz_id','id');
}
public function assignedquiz() {
    return $this->hasMany('App\AssignedQuiz','assigned_id','id');
}

public function QuestionPaginate(){

  $questions=Question::where("quiz_id",$this->id)->paginate(1);
        //  ->orWhere("id",1)
        //  ->orderBy('id', 'desc')
           
  
  return $questions;
}

public function getgrate($code){

  $grade = AssignedQuiz::where('code',$code)->first()->grade;
           
  
  return $grade;
}

}
