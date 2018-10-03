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
                @if(0)
                <hr>
                {{Form::open(['route'=>'useranswer.store','method'=>'POST'])}}
                {{Form::textarea('useranswer','Insert answer',['class'=>'form-control textarea','rows'=>'4'])}}
                {{Form::hidden('question_id',$question->id)}}
                {{Form::hidden('user_id',1)}}
                <br>
                {{Form::submit('Submit',['class'=>'btn  question-answer-button'])}}                      
                {{ Form::close() }}
            </li>
            @endif    
            <br>

            {{ Form::open(['route' => ['useranswer.update', $question->id], 'method' => 'put']) }}

            <ul>
                @foreach($question->Answers() as $answer)

                <li class="row">
                    <div  class="col-sm-1 col-md-1 btn-sm">

                    </div>

                    <div class="col-sm-7 col-md-7 "> <h3>
                        @if($question->UserAnswers($answer->id))
                        {{ Form::checkbox('answers[]',$answer->id,'yes') }}
                        {{ Form::label('answers', $answer->body) }}
                        @else
                        {{ Form::checkbox('answers[]',$answer->id) }}
                        {{ Form::label('answers', $answer->body) }}                      
                        @endif   
                        
                        </h3>
                    </div>

                </li>

                @endforeach

            </ul>

            {{Form::submit('Save',['class'=>'btn  question-answer-button'])}}
            {{ Form::close() }}

        </div>
        @endforeach
        <div class="container col-sm-4">
            {{ $quiz->QuestionPaginate()->links() }}
        </div>
    </ul>
    <div class=" col-sm-4">
        <button type="button" class="btn btn-success" value="Input Button" onclick="makenewquestion()"> Add question to quiz </button>
    </div>
    
    <h3><a href="/{{$quiz->name}}/1">Check results</a></h3>
    <br>
</div>


<script>
    function makenewquestion() {

        location.href = "{{route('CreateQuestion',['main' => $quiz->name ])}}";
    }
</script>

@endsection
