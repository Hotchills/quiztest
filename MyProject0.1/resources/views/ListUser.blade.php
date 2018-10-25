@extends('layouts.app')

@section('content')


<h2>List of Users :</h2>
<br>
<ul class="list-group row" >
    @foreach($guestusers as $guestuser)

    <li class="list-group-item"><h3>{{$guestuser->id}}. {{$guestuser->email}}  is assigned to the following tests : </h3>
    @foreach($guestuser->assignedq() as $assigned)
   
   <p> ID of quiz : {{ $assigned->quiz_id }} /  Code to start: {{ $assigned->code }}</p>
    
    @endforeach

    {{Form::open(['route'=>'assignedquiz.store','method'=>'POST'])}}
    {{Form::number('QuizID', 'value')}}
    {{Form::hidden('guestuserid', $guestuser->id) }}
    {{Form::submit('Add quiz to this user',['class'=>'btn btn-primary'])}}
    {{Form::close() }}
    @endforeach
</li>
    <br>

</ul>

<h2>Test list :</h2>
<br>
<ul class="list-group row" >
    @foreach($quizzes as $quiz)

    <li class="list-group-item"><h3>{{$quiz->id}}. {{$quiz->body}}</h3></li>

    @endforeach

    <br>

</ul>

@endsection
