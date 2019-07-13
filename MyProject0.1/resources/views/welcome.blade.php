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
        
        <script src="{{ asset('js/app.js') }}" defer></script>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        
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
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                position: relative;
                height: 100%;
                width: 100%;
                -webkit-transform-style: preserve-3d;
                transform-style: preserve-3d;
                -webkit-transition: all 600ms;
                transition: all 600ms;
                z-index: 20;
                background: #02C54C;
            }

            .card div {
                position: absolute;
                height: 100%;
                width: 100%;
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
                box-shadow: 2px 6px 16px 0 rgba(0, 0, 0, 0.3), 2px 12px 24px 0 rgba(0, 0, 0, 0.2);
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
            }
            .center_login {

                margin:0 auto;
                width: 50%;
                top: 20%;
            }
            .thefront{
                padding: 3%;
                
            }

        </style>
    </head>

    <body>
        <label>
            <input type="radio"  />
            <div class="card" >
                <div class="thefront"><img src="images/Mainpage/logo-flip.png"></div>
                <div class="theback " >               
                    <div class="center_login container p-0" >

                        {{Form::open(['route'=>'loginguestuser.show','method'=>'POST'])}}
                        {{Form::label('code','Insert Code:')}}
                        <br>
                        {{Form::text('code','',['class'=>'form-control ','Style'=>'width: 90%; margin:0 auto;'])}}
                        <br>
                        <div class="center_login" >
                            {{Form::submit('Start Test',['class'=>'btn btn-warning'])}}
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
        </label>
    </body>
</html>﻿
