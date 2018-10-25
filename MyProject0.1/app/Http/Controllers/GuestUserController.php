<?php

namespace App\Http\Controllers;

use App\GuestUser;
use Illuminate\Http\Request;

class GuestUserController extends Controller
{
   /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:GuestUser');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('GuestUser');
    }
}
