
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">


        <title>{{ config('app.name', 'Godaddy DCOps') }}</title>
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <!-- Scripts -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
       <!--  <script src="{{ asset('js/app.js') }}" defer></script> -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">

        <!-- Styles -->
      


        <style>
            .hidden {
                display: none;
            }
            .dropdown-menu{
                padding: 0px;

            }
            .btn-fordropdown{

                width:100%;
                border:0px;
                border-radius:0px;
            }
            /* Adding style to the paginate buttons*/
            .page-item.active .page-link{

                background-color: #00a63f;
                border-color: #015B23;
            }
            .page-link{
                color: black;    
                font-weight: bold;
            }

            .page-link:focus {
                box-shadow:0 0 0 0.2rem rgba(0, 154, 35, 0.25);
            }
            .pagination:focus{
                outline-color:#00a63f;}
            /* end of paginate */    
            /* Adding style quiz page*/
            .question-box{     
                border:10px solid #00a63f ;

                margin:20px;
                border-radius:5px;
                padding:25px;
                -moz-box-shadow: 1px 2px 4px rgba(0, 0, 0,0.5);
                -webkit-box-shadow: 1px 2px 4px rgba(0, 0, 0, .5);
                box-shadow: 1px 1px 10px rgba(0, 154, 35, 0.5);
            }  
            .quiz-box{
                width:100%;
                margin:0 auto;
                box-shadow: 1px 2px 3px rgba(0, 0, 0, 0.5);


            }
            .question-answer-button{
                background-color: white;
                border-color: #015B23;
                color:black;
                font-weight: bold;
                border:1px solid #00a63f;

            }

            .question-answer-button:hover,.question-answer-button:active{
                box-shadow:0 0 0 0.2rem rgba(0, 154, 35, 0.25);
                background-color: #00a63f;
                color:white;

            }

            /* end of quiz page*/

            /*login page*/
            .center_login {

                margin: auto;
                width: 50%;
                top: 80%;

            }

            .background_green {

                background-color: #00a63f;    

            }

            /*login register*/
            .center_register {

                margin: auto;
                width: 70%;
                top:40%;

            }

            /*General Center*/
            .center {
                margin:auto;
                Right: 20%;
                width: 70%;
                top:50%;
                     }

            /*Flip Main page*/
            /*dropdown menu*/
            .dropbtn {
                background-color: #4CAF50;
                color: white;
                padding: 16px;
                font-size: 16px;
                border: none;
            }
            .dropbtn2 {
                background-color: #4CAF50;
                color: white;
                padding: 16px;
                font-size: 16px;
                border: none;
            }

            .dropdown {
                position: relative;
                display: inline-block;
            }

            .dropdown-content {
                display: none;
                position: absolute;
                background-color: #f1f1f1;
                min-width: 160px;
                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                z-index: 1;
            }

            .dropdown-content a {
                color: black;
                padding: 12px 16px;
                text-decoration: none;
                display: block;
            }

            .dropdown-content a:hover {background-color: #ddd;}

            .dropdown:hover .dropdown-content {display: block;}

            .dropdown:hover .dropbtn {background-color: #3e8e41;}

            .container{
                
                background:#F0F0F0;
                border:0.5px solid #DCDCDC;
                padding: 2%;
                 border-radius: 12px;
            }
            /*end*/

        </style>
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light navbar-laravel"Style="padding-left:15%;padding-right:15%;background:#00a63f;box-shadow: 1px 2px 3px rgba(0, 0, 0, 0.5);">

                    <a href="{{ url('/') }}">     <img  src="/images/Mainpage/logo-smal.png" height="50px"/>
                         </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto navbar-left">
                        </ul>
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto navbar-right">
                            <!-- Authentication Links -->

                            @if(0)  
                            <a  href="{{ route('login') }}"><strong>{{ __('Login') }}</strong></a>
                            @endif

                            @guest
                            <!-- No menu for not logged in users -->
                            @else
                            <!-- menu for logged in users -->
                            <li class="nav-item dropdown">
                                <a Style='padding-left: 18px;padding-right: 18px;' id="navbarDropdown" class="nav-link dropdown-toggle btn btn-default" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <strong>{{ ucfirst(Auth::user()->name) }} </strong>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="/home" >Home</a>
                                    <a class="dropdown-item" href="/CreateGuestUser" >Create User</a>
                                    <a class="dropdown-item" href="/LoginUser" >Login Page with code</a>
                                    <a class="dropdown-item" href="/{{Auth::user()->location}}/ListUser"  >Assign User to Quiz</a>
                                    <a class="dropdown-item" href="/CreateQuiz" >Create quiz</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}  
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @endguest
                        </ul>

            </nav>

            <main class="py-4">
                <div class="center">
                    <div class="col-md-8">
                        @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                        @endif

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        
                        @yield('content')

                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
