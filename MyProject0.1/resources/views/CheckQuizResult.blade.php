@extends('layouts.app')

@section('content')


<div class="quiz-box card">
    <div class="card-header">
        <h1>Quiz ID: <strong>{{$quiz->id}} &nbsp </strong>Quiz Name: <strong> {{$quiz->name}}</strong></h1>
        <h2>{{$quiz->title}}</h2>
        <h4>CODE :  {{$code}} </h4>
    </div>
    <br>
    <ul class="list-group container">
        @foreach($questions as $indexKey =>$question)

        <li class="list-group-item list-group-item-success"><h2>{{$indexKey+1 }}.{{ $question->body }} / {{$question->question_nr}} :  </h2>
        </li>  

        @foreach($question->answers() as $indexKey2 => $answer)  
        <li class="list-group-item">
            <div class="row" >
                <div class="col-sm-7 col-md-7 col-xs-7" ><h4>


                        {{$indexKey2+1 }}. {{$answer->body }} 

                        @if(!$answer->Getcorrectanswers())
                        -
                        @elseif($answer->Getcorrectanswers()->answer_id == $answer->id )
                        &#10004
                        @endif

                    </h4>


                </div>

                <div class="col-sm-3 col-md-3 col-xs-3">
@if(0)
                    @if(!$answer->Getcorrectanswers())
                    @if($question->CompareUserAnswer($answer->id, $code))
                    <div Style='color: red;'>bad </div>             
                    @endif   

                    @elseif($answer->Getcorrectanswers()->answer_id == $answer->id )

                    @if($question->CompareUserAnswer($answer->id, $code))
                   <div Style='color: green;'> &#10004 good   </div>  
                    @else
                 <div Style='color: red;'> bad </div>  
                    @endif   
                    @endif
@endif

                </div>
            </div>

        </li>
        @endforeach
        <br>

        @endforeach

    </ul>

    <div class="container">
       <h1><strong> Grade : {{$quiz->getgrate($code)}}%</strong></h1>
    </div>

</div>


@endsection
