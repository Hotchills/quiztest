<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
  public $table = 'questions';
protected $fillable = [
  'question_nr', 'type', 'body', 'quiz_id',
];

public function quiz() {
  return $this->belongsTo('App\Quiz','quiz_id','id');
}

public function answer() {
  return $this->hasMany('App\Answer','question_id','id');
}
public function useranswer() {
  return $this->hasMany('App\UserAnswer','question_id','id');
}



}
