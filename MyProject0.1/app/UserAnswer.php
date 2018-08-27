<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{

  
protected $fillable = [
  'user_id', 'question_id', 'body',
];

public function user() {
    return $this->belongsTo('App\User', 'user_id', 'id');
}
public function question() {
    return $this->belongsTo('App\Question', 'question_id', 'id');
}


}
