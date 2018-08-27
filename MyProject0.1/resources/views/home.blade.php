@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">Dashboard</div>

    <div class="card-body">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif

        You are logged in!
    </div>

    <div class="card-body">
        <h2>Available quizzes: </h2>

        @foreach($quizzes as $quiz)

        <h2><a href="/{{$quiz->name}}">{{$quiz->title}}</a></h2>
        @endforeach

    </div>

    <button type="button" class="btn btn-success" value="Input Button" onclick="makenewquiz()">Add quiz</button>
</div>


<script>
    function makenewquiz() {

        location.href = "{{route('CreateQuiz')}}";
    }
</script>


@endsection
