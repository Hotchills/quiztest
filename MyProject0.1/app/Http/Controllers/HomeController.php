<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quiz;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['rootpage']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $quizzes=Quiz::All();

         return view('home', compact('quizzes'));
    }
        public function rootpage()
    {
         return view('welcome');
    }
    
            public function adminpage()
    {
         return view('admin');
    }
}
