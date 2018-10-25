@extends('layouts.app')

@section('content')

<div class="card-body">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif

</div>

<div class="card-body">


    <h2>Quiz type : <strong>{{$question->type}}</strong></h2>
    <p>question body :<strong> {{$question->body}} </strong></p>


</div>


<h2><strong>Answers for this question:</strong> </h2>

<ul class="list-group" >
    
    @foreach($question->Answers() as $answer)
<div  class="list-group-item">
    <li class="row"> 

        <div class="col-sm-9 col-md-9 col-xs-9"><h3>{{$answer->body}}</h3>

        </div>

        <div  class="col-sm-1 col-md-1  col-xs-1 btn-sm">
            {{ Form::open(['method' => 'DELETE', 'route' => ['delanswer.delete', $answer->id]]) }}
            {{Form::submit('Delete',['class'=>'btn btn-danger '])}} 
            {{ Form::close() }}

        </div>
                @if($question->question_nr != $answer->id)
        <div  class="col-sm-1 col-md-1 btn-sm">
            {{ Form::open(['method' => 'PUT', 'route' => ['correctanswer.update', $question->id]]) }}
            {{Form::hidden('answerid',$answer->id)}}
            {{Form::submit('Correct',['class'=>'btn btn-success '])}} 
            {{ Form::close() }}
        </div>
        @endif

    </li>
</div>
    @endforeach
</ul>
<br>
<h2><strong>Add another answer : </strong></h2>
{{Form::open(['route'=>'addanswers.store','method'=>'POST'])}}
{{Form::textarea('saveanswer','Insert new answer here',['class'=>'form-control textarea','rows'=>'1'])}}
{{Form::hidden('question_id',$question->id)}}

<br>
{{Form::submit('Add answer',['class'=>'btn  btn-default'])}}                      
{{ Form::close() }}
<br>

@if($question->question_nr != NULL)
<h2><a href="/{{$quizname}}">Return to {{$quizname}}</a></h2>
@else
<h2><strong>Don't forget to add the correct answer by clicking  on the <button class="btn btn-success">Correct</button> button .</strong><h2>
@endif
@endsection
