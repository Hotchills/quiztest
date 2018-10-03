<?php

namespace App;

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
}
