<?php

namespace App\Http\Controllers;

use App\GuestUser;
use App\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GuestUserController extends Controller {

    function __construct() {

        $this->middleware('auth');
    }

    public function index() {
        return view('CreateGuestUser');
    }

    public function showusers($location) {
        //

        if ($location == "ALL") {
            if ($guestusers = GuestUser::all()) {
                if ($quizzes = Quiz::all()) {
                    return view('ListUsers', compact('guestusers', 'quizzes', 'location'));
                }
            }
        }

        if ($guestusers = GuestUser::where('info1', $location)->get()) {
            if ($quizzes = Quiz::all()) {
                return view('ListUsers', compact('guestusers', 'quizzes', 'location'));
            }
        }
        abort(404);
    }
  public function showuser($id) {
      
      $guestusers = GuestUser::where('id', $id)->get();
      $quizzes = Quiz::all();
      $location='All';
       return view('ListUser', compact('guestusers', 'quizzes','location'));
  }
    public function search(Request $request) {
        $keywords=$request->name;
        $guestusers = GuestUser::where('email', $request->name)->get();
        $quizzes = Quiz::all();
        $location='ALL';
         
        return view('ListUser', compact('guestusers', 'quizzes','location'));
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'email' => 'required|unique:guest_users|max:100|min:3',
            'location' => 'required|string|max:255',
                //         'name' => 'required|unique:quizzes|max:40|min:3',
                //          'body' => 'max:500',
        ]);
        if ($request->location == "Default")
            return redirect()->back()->withErrors('Please select a location');

        $GuestUser = new GuestUser();
        $GuestUser->email = $request->email;
        $GuestUser->password = str_random(8);
        $GuestUser->code = 0;
        $GuestUser->info1 = $request->location;
        $GuestUser->info2 = 0;
        $GuestUser->info3 = 0;


        $GuestUser->save();

        return redirect()->back()->with('message', 'User added');
        //   return redirect()->to('/'.$quiz->name)->with('message', 'Quiz added');
    }

}
