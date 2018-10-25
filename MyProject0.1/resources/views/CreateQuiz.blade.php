@extends('layouts.app')

@section('content')




<h2>Add new quiz</h2>

{{Form::open(['route'=>'quiz.store','method'=>'POST'])}}
{{Form::label('name','No empty spaces for URL:')}}
{{Form::text('name','',['class'=>'form-control'])}}

{{Form::label('title','Title:')}}
{{Form::text('title','Title',['class'=>'form-control'])}}

{{Form::label('body','body:')}}
{{Form::textarea('body','Body',['class'=>'form-control textarea','rows'=>'7'])}}
{{Form::submit('Add quiz',['class'=>'btn btn-primary'])}}

{{ Form::close() }}



@endsection
