@extends('layouts.app')

@section('content')


<div class="quiz-box card">
    <div class="card-header">
        @auth
        <h1>Name: <strong> {{$quiz->name}}</strong></h1>

        <p>Debug info quizID: <strong>{{$quiz->id}}</strong></p> 
        @endauth
        <h1>{{$quiz->title}}</h1>
    </div>



    <ul class="card-body" Style="list-style: none;">
        <div class="row">       
            <div class="col">  


            </div>
            <div class="col text-right"> 

            </div>
        </div>

        <div class="question-box">
            <li> <h1>Some info here</h1><a class="btn btn-success"href="/{{$code}}/{{$quiz->name}}">Start test</a>
            </li>
            <br>
            <ul class="list-group row" >

                <br>

            </ul>

        </div>

    </ul>

    <br>
</div>




@endsection
