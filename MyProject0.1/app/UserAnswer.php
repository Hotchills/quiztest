<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{

  
protected $fillable = [
  'user_id', 'question_id', 'body',
];

public function guestuser() {
    return $this->belongsTo('App\GuestUser', 'user_id', 'id');
}
public function question() {
    return $this->belongsTo('App\Question', 'question_id', 'id');
}


}
