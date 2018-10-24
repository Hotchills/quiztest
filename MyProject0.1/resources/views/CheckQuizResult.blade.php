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
        @foreach($questions as $question)

        <li class="list-group-item list-group-item-success">   <h2>{{ $question->body }} / {{$question->question_nr}} :  </h2>
        </li>  

        @foreach($question->answers() as $answer)  
        <li class="list-group-item">
            @if($answer->id == $question->question_nr)
            <div class="row" >

                <div class="col-sm-7 col-md-7 col-xs-7" ><h4>{{$answer->id }}. {{$answer->body }} &#10004</h4>
                </div>
                <div class="col-sm-3 col-md-3 col-xs-3">
                    @foreach($question->UserAnswers2() as $useranswer)
                    @if( $useranswer->body  == $answer->id )

                    <h3> <strong Style="color: green;"> &#10004  good</strong> </h3>
                    @endif
                    @endforeach
                </div>

            </div>
            @else
            <div class="row">
                <div class="col-sm-7 col-md-7 col-xs-7"><h4>{{$answer->id }}. {{$answer->body }} </h4>
                </div>
                <div class="col-sm-3 col-md-3 col-xs-3">
                    @foreach($question->UserAnswers2() as $useranswer)
                    @if( $useranswer->body  == $answer->id )
                    <h3>  <strong Style="color: red;"> X bad </strong> </h3>
                    @endif
                    @endforeach

                </div> 
            </div>
            @endif

            @endforeach
        </li>

        @if(0)
        <div class="col-xs-4 col-md-4 col-sm-4">
            @foreach($question->UserAnswers2() as $useranswer)

            <li> 
                @if( $useranswer->body  == $question->question_nr)
                <button class='btn btn-success'> good</button>
                @else
                <button class='btn btn-danger'> bad </button>
                @endif
                {{$useranswer->body}}
            </li> 
            @endforeach
        </div>   
        @endif

        <br>

        @endforeach

    </ul>

    <div class=" col-sm-4">

    </div>

</div>


@endsection
