@extends('layouts.app')

@section('content')


<div class="quiz-box card">
    <div class="card-header">
        <h1>Quiz ID: <strong>{{$quiz->id}} &nbsp </strong>Quiz Name: <strong> {{$quiz->name}}</strong></h1>
        <h1>{{$quiz->title}}</h1>
        <h1>User ID :  1 </h1>
    </div>
    <ul class="card-body " Style="list-style: none;">
@foreach($questions as $question)
    <li class='container' Style='border:1px green solid;'> 
   <ul> <h3>{{ $question->body }} / {{$question->question_nr}} ::  </h3>
  
    @foreach($question->answers() as $answer)   
  <l1> <p> {{$answer->body }}</p> </li> 
    @endforeach
  
    ////
    @foreach($question->UserAnswers2() as $useranswer)
     
    {{$useranswer->body }}
    
    @if( $useranswer->body  == $question->question_nr)
   <button class='btn btn-success'> good answer</button>
    @else
    <button class='btn btn-danger'> bad answer</button>
    @endif
    
    @endforeach
    </ul>
    </li>
   <br>
        @endforeach
        
    </ul>
    
    <div class=" col-sm-4">
        
    </div>

</div>


@endsection
