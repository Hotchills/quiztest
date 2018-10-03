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


    <h2>Quiz : {{$question->type}}</h2>
    <p> {{$question->body}} </p>


</div>


<p> Add answers1 : </p>

<ul class="list-group" >
    
    @foreach($question->Answers() as $answer)

    <li class="row list-group-item" > 

        <div class="col-sm-7 col-md-7 ">{{$answer->body}}

        </div>

        <div  class="col-sm-3 col-md-3 btn-sm">
            {{ Form::open(['method' => 'DELETE', 'route' => ['delanswer.delete', $answer->id]]) }}
            {{Form::submit('Delete',['class'=>'btn btn-danger '])}} 
            {{ Form::close() }}

        </div>
                @if($question->question_nr != $answer->id)
        <div  class="col-sm-1 col-md-1 btn-sm">
            {{ Form::open(['method' => 'PUT', 'route' => ['correctanswer.update', $question->id]]) }}
            {{Form::hidden('answerid',$answer->id)}}
            {{Form::submit('Up',['class'=>'btn btn-warning '])}} 
            {{ Form::close() }}
        </div>
        @endif

    </li>

    @endforeach
</ul>
{{Form::open(['route'=>'addanswers.store','method'=>'POST'])}}
{{Form::textarea('saveanswer','Insert new answer here',['class'=>'form-control textarea','rows'=>'1'])}}
{{Form::hidden('question_id',$question->id)}}

<br>
{{Form::submit('Submit',['class'=>'btn  btn-default'])}}                      
{{ Form::close() }}

<h2><a href="/{{$quizname}}">Return to {{$quizname}}</a></h2>
@endsection
