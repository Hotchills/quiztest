<?php

namespace App\Http\Controllers;

use App\GuestUser;
use App\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GuestUserController extends Controller {

    public function index() {
        return view('CreateGuestUser');
    }
    
    public function showusers() {
        //
        if ($guestusers = GuestUser::all() ) {
          if ( $quizzes = Quiz::all()) {
            return view('ListUser', compact('guestusers','quizzes'));
          }
        }
        abort(404);
    }

    public function store(Request $request) {
        //      $validatedData = $request->validate([
        //          'title' => 'required|unique:quizzes|max:100|min:3',
        //         'name' => 'required|unique:quizzes|max:40|min:3',
        //          'body' => 'max:500',
        //     ]);

        $GuestUser = new GuestUser();
        $GuestUser->email = $request->email;
        $GuestUser->password =0;
        $GuestUser->code = 0;
        $GuestUser->info1 = 0;
        $GuestUser->info2 = 0;
        $GuestUser->info3 = 0;


        $GuestUser->save();

        return redirect()->back()->with('message', 'User added');
        //   return redirect()->to('/'.$quiz->name)->with('message', 'Quiz added');
    }

}
