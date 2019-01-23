@extends('layouts.app')

@section('content')



<div class="card-body" Style='border:0.5px solid #DCDCDC;background:#F0F0F0;border-radius:15px;'>

    <h2>Add new question</h2>

    {{Form::open(['route'=>'question.store','method'=>'POST'])}}

    {{Form::text('type','Type',['class'=>'form-control'])}}

    {{Form::hidden('id',$quiztempid)}}

    {{Form::textarea('body','Body',['class'=>'form-control textarea','rows'=>'4'])}}

    {{Form::submit('Add question',['class'=>'btn btn-primary'])}}

    {{ Form::close() }}

    <h2><a href="/{{$quizname}}">Return to {{$quizname}}</a></h2>
    
</div>
@endsection
