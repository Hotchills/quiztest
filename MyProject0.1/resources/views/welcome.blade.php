<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale = 1">
        <title>Godaddy DCOps</title>

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

   <!-- @import url(https://fonts.googleapis.com/css?family=Open+Sans);  -->
        <style>
      

body {
    background: #02C54C;
}

label {
    -webkit-perspective: 1000px;
    perspective: 1000px;
    -webkit-transform-style: preserve-3d;
    transform-style: preserve-3d;
    display: block;
    width: 300px;
    height: 350px;
    position: absolute;
    left: 50%;
    top: 50%;
    -webkit-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
    cursor: pointer;
}

.card {
    position: relative;
    height: 100%;
    width: 100%;
    -webkit-transform-style: preserve-3d;
    transform-style: preserve-3d;
    -webkit-transition: all 600ms;
    transition: all 600ms;
    z-index: 20;
 
}

    .card div {
        position: absolute;
        height: 100%;
        width: 100%;
        background: #02C54C;
        text-align: center;
      
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        
    }

    .card .theback {
        
     
        -webkit-transform: rotateX(180deg);
        transform: rotateX(180deg);
    }

label:hover .card {
    -webkit-transform: rotateX(20deg);
    transform: rotateX(20deg);
    box-shadow: 0 20px 20px rgba(50,50,50,.2);
}

input {
    display: none;
}

:checked + .card {
    transform: rotateX(180deg);
    -webkit-transform: rotateX(180deg);
}

label:hover :checked + .card {
    transform: rotateX(180deg);
    -webkit-transform: rotateX(180deg);
    box-shadow: 0 20px 20px rgba(255,255,255,.2);
}
 .center_login {

                margin: auto;
                width: 50%;
                top: 20%;
                

            }
            
            

        </style>
    </head>

    <body>
        <label>
            <input type="checkbox"  />
             <div class="card" Style="border : 2px solid #02C54C;" >

                <div class="thefront"><img src="images/Mainpage/logo-flip.png"></div>

                <div class="theback" >               

                     
                            <div class="center_login" >

                                {{Form::open(['route'=>'loginguestuser.show','method'=>'POST'])}}
                                {{Form::label('code','Insert Code:')}}
                                <br>
                                {{Form::text('code','',['class'=>'form-control'])}}


                            <div class="center_login" >
                                {{Form::submit('Start Test',['class'=>'btn btn btn-warning'])}}
                           </div>
                                {{ Form::close() }}


                            </div>
       </div>
</label>
</body>
</html>﻿
