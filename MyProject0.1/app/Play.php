<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Play extends Model
{
        public $table = 'plays';
    protected $fillable = [
        'name', 'answer', 'question_id','body','info_string','info_int',
    ];

    public function question() {
        return $this->belongsTo('App\Question');
    }
    
}
