@extends('layouts.app')

@section('content')


        <div class="quiz-box card">
            <div class="card-header">
                <h1>Quiz ID: <strong>{{$quiz->id}} &nbsp </strong>Quiz Name: <strong> {{$quiz->name}}</strong></h1>
                <h1>{{$quiz->title}}</h1>
            </div>
            <ul class="card-body" Style="list-style: none;">
                @foreach($quiz->QuestionPaginate() as $question)
                <div class="question-box">

                    <li><h3><span class="badge badge-success">{{$quiz->QuestionPaginate()->currentPage() }}.</span><strong>&nbsp {{$question->body}}</strong></h3>

                        <hr>
                        {{Form::open(['route'=>'useranswer.store','method'=>'POST'])}}
                        {{Form::textarea('useranswer','Insert answer',['class'=>'form-control textarea','rows'=>'4'])}}
                        {{Form::hidden('question_id',$question->id)}}
                        {{Form::hidden('user_id',1)}}
                      <br>
                        {{Form::submit('Submit',['class'=>'btn  question-answer-button'])}}                      
                        {{ Form::close() }}
                    </li>

                </div>
                @endforeach
                <div class="container col-sm-4">
                {{ $quiz->QuestionPaginate()->links() }}
                </div>
            </ul>
            <div class=" col-sm-4">
            <button type="button" class="btn btn-success" value="Input Button" onclick="makenewquestion()"> Add question to quiz </button>
        </div>
            <br>
            </div>


<script>
    function makenewquestion() {

        location.href = "{{route('CreateQuestion',['main' => $quiz->name ])}}";
    }
</script>

@endsection
