
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        

        <title>{{ config('app.name', 'Godaddy DCOps') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">


        <style>
            .hidden {
                display: none;
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
                width: 70%;
                top:50%;
                border:solid 1px;

            }

            /*Flip Main page*/




                   
        </style>
    </head>
    <body >
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light navbar-laravel"Style="background:#00a63f;box-shadow: 1px 2px 3px rgba(0, 0, 0, 0.5);">
                <div class="container">
                    <a href="{{ url('/') }}"> <button  Style ="padding:0px;border:0px;"class="navbar-brand btn btn-default" >              
                            <img  src="/images/Mainpage/logo-smal.jpg" height="50px"/>
                        </button > </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}"><strong>{{ __('Login') }}</strong></a>
                            </li>

                            @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <strong>{{ Auth::user()->name }} <span class="caret"></span> </strong>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ url('/admin') }}">
                                        Control panel
                                    </a>

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
                    </div>
                </div>
            </nav>

            <main class="py-4">
                <div class=" row justify-content-center ">
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
