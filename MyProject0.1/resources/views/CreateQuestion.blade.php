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

<h2>Add new question</h2>
    <div class="form-inline">
        {{Form::open(['route'=>'question.store','method'=>'POST'])}}


        {{Form::text('title','Title',['class'=>'form-control'])}}
</div>

    <div class="form-inline">
        {{Form::hidden('id',$quiztempid)}}
    </div>


        {{Form::textarea('body','Body',['class'=>'form-control textarea','rows'=>'4'])}}
  
<hr>

        {{Form::textarea('answer','Add keyward',['class'=>'form-control textarea','rows'=>'4'])}}
<br>

    {{Form::submit('Add question',['class'=>'btn btn-primary'])}}


    {{ Form::close() }}
</div>

@endsection
