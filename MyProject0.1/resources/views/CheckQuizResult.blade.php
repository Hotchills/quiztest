@extends('layouts.app')

@section('content')


<div class="quiz-box card">
    <div class="card-header">
        <h1>Quiz ID: <strong>{{$quiz->id}} &nbsp </strong>Quiz Name: <strong> {{$quiz->name}}</strong></h1>
        <h1>{{$quiz->title}}</h1>
        <h1>User ID :  1 </h1>
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

                    @if(!$answer->Getcorrectanswers())
                    
                    -
                    @elseif($answer->Getcorrectanswers()->answer_id == $answer->id )
                    &#10004
                    @endif

                    @if($question->CompareUserAnswer($answer->id, $code))
                user clicked              
                    @endif      
                </div>
            </div>

</li>
            @endforeach
            <br>

            @endforeach

    </ul>

    <div class=" col-sm-4">

    </div>

</div>


@endsection
