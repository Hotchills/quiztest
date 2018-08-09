@extends('layouts.app')

@section('content')

<div class="container" Style="width:50%">

  @if (session()->has('message'))
  <div class="alert alert-success">
      {{ session()->get('message') }}
  </div>
  @endif

  @if ($errors->any())
  <div class="alert alert-danger">
      <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
  @endif


<h2>Add new quiz</h2>

        {{Form::open(['route'=>'quiz.store','method'=>'POST'])}}
        {{Form::label('name','Name:')}}
        {{Form::text('name','',['class'=>'form-control'])}}

        {{Form::label('title','Title:')}}
        {{Form::text('title','Title',['class'=>'form-control'])}}

        {{Form::label('body','body:')}}
        {{Form::textarea('body','Body',['class'=>'form-control textarea','rows'=>'7'])}}

    {{Form::submit('Add quiz',['class'=>'btn btn-primary'])}}


    {{ Form::close() }}


</div>

@endsection
