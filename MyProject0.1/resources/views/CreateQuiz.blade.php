@extends('layouts.app')

@section('content')


<div class="container">

<h2>Add new quiz</h2>

{{Form::open(['route'=>'quiz.store','method'=>'POST'])}}
{{Form::label('name','This is the URL(only alpha-numeric characters):')}}
{{Form::text('name','',['class'=>'form-control'])}}

{{Form::label('title','Title:')}}
{{Form::text('title','Title',['class'=>'form-control'])}}

{{Form::label('body','body:')}}
{{Form::textarea('body','Body',['class'=>'form-control textarea','rows'=>'7'])}}
<br>
{{Form::submit('Add quiz',['class'=>'btn btn-success'])}}

{{ Form::close() }}

</div>

@endsection
