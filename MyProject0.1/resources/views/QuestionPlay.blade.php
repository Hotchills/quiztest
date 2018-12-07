@extends('layouts.app')

@section('content')


<div class="quiz-box card">
    <div class="card-header">
       
       
 
    
    </div>



    <ul class="card-body" Style="list-style: none;">
{{ Form::open(['method' => 'POST', 'route' => ['play.save']]) }}
        <div class="question-box">
             <h1> <strong>{{$question->id}}.</strong> {{$question->body}} </strong></h1>

            <li><h3><span class="badge badge-success" ></span><strong></strong></h3>
            </li>
            <br>
            <ul class="list-group row" >
                @foreach($question->Answers() as  $key=>$answer )
 
                <li class="list-group-item">{{ Form::radio('result', $answer->body , false, array('id'=>'result-'.$key)) }} {{ Form::label('result-'.$key, $answer->body) }} </li>
                 
                @endforeach

                <br>
            </ul>
        </div>
        <div class="container">
                    {{ Form::hidden('questionid',$question->id) }}
        {{ Form::text('name','Name',['class'=>'form-control'])}}
        {{ Form::textarea('body','Info',['class'=>'form-control textarea','rows'=>'4'])}}
        {{ Form::submit('Save ',['class'=>'btn btn-danger '])}} 
        {{ Form::close() }}
        </div>
    </ul>

    <br>
</div>




@endsection
