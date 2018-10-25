<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignedQuiz extends Model {

    //
    public $table = 'assigned_quizzes';
    protected $fillable = [
        'code', 'grade', 'time',
    ];

    public function quiz() {
        return $this->belongsTo('App\Quiz', 'quiz_id', 'id');
    }

    public function guestuser() {
        return $this->belongsTo('App\GuestUser', 'guestuser_id', 'id');
    }

}
