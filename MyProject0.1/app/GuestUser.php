<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\AssignedQuiz;


class GuestUser extends Model {
// The authentication guard for admin

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $table = 'guest_users';
    protected $fillable = [
        'email', 'password', 'code', 'userinfo1', 'userinfo2', 'userinfo3',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function assignedquiz() {
        return $this->hasMany('App\AssignedQuiz');
    }
    
    public function assignedq() {
        
        $assignedq = AssignedQuiz::where('guestuser_id',$this->id)->get();
        
        return $assignedq;
    }
    
    

}
