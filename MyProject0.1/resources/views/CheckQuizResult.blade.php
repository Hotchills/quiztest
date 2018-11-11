@extends('layouts.app')

@section('content')

<div class="quiz-box card">
    <div class="card-header">
        <h1></strong>Quiz Name: <strong> {{$quiz->name}}</strong></h1>
        <h2>{{$quiz->title}}</h2>
        <h4>CODE :  {{$code}} </h4>
    </div>
    <br>
    <ul class="list-group container" >
        @foreach($questions as $indexKey =>$question)

        <li class="list-group-item" Style="border:green 3px solid;border-radius:5px;" ><h2><span class="badge badge-success" >{{$indexKey+1 }}.</span> {{ $question->body }} :  </h2>

            <ul class="list-group" >
                @foreach($question->answers() as $indexKey2 => $answer) 
                @if(!$answer->Getcorrectanswers())

                <li class="list-group-item"Style="">
                    @elseif($answer->Getcorrectanswers()->answer_id == $answer->id )
                <li class="list-group-item list-group-item-success">
                    @endif
                    <div class="row" >
                        <div class="col-sm-10 col-md-10 col-xs-10">

                            {{$indexKey2+1 }}. {{$answer->body }} 

                        </div>
                        <div class="col-sm-2 col-md-2 col-xs-2">

                            @if(!$answer->Getcorrectanswers())
                            @if($question->CompareUserAnswer($answer->id, $code))
                            <div Style="color: red;">x bad</div>             
                            @endif   

                            @elseif($answer->Getcorrectanswers()->answer_id == $answer->id )

                            @if($question->CompareUserAnswer($answer->id, $code))
                            <div Style="color: green;"> &#10004 good   </div>  
                            @else
                            <div Style="color: red;"> not selected</div>  
                            @endif   
                            @endif

                        </div>
                    </div>

                </li>
                @endforeach
            </ul>
        </li> 
        <br>
        @endforeach

    </ul>

    <div class="container">
        <h1><strong> Grade : {{$quiz->getgrate($code)}}%</strong></h1>
    </div>

</div>


@endsection
