@extends('layouts.app')

@section('content')

<div class="card-body">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif

</div>

<div class="card-body" Style='border:0.5px solid #DCDCDC;background:#F0F0F0;border-radius:15px;'>

    <h2>Question type : <strong>{{$question->type}}</strong></h2>
    <p>Question body :<strong> {{$question->body}} </strong></p>
    <h2><strong>Answers for this question:</strong> </h2>
    <ul class="list-group" >

        @foreach($question->Answers() as $answer)
        <div  class="list-group-item">
            <li class="row"> 
                <div class="col-sm-9 col-md-9 col-xs-9"><h3>{{$answer->body}}</h3>
                </div>

                <div  class="col-sm-1 col-md-1  col-xs-1 btn-sm">
                    {{ Form::open(['method' => 'DELETE', 'route' => ['delanswer.delete', $answer->id]]) }}
                    {{Form::submit('Delete',['class'=>'btn btn-danger '])}} 
                    {{ Form::close() }}
                </div>

                <div  class="col-sm-1 col-md-1 btn-sm">
                    @if(!$answer->Getcorrectanswers())

                    {{ Form::open(['method' => 'PUT', 'route' => ['correctanswer.store', $question->id]]) }}
                    {{Form::hidden('answerid',$answer->id)}}
                    {{Form::submit('Correct',['class'=>'btn btn-success '])}} 
                    {{ Form::close() }}

                    @elseif($answer->Getcorrectanswers()->answer_id == $answer->id )

                    {{ Form::open(['method' => 'DELETE', 'route' => ['delcorrectanswer.delete', $answer->Getcorrectanswers()->id]]) }}
                    {{Form::hidden('questionid',$question->id)}}
                    {{Form::submit('Remove correct',['class'=>'btn btn-danger '])}} 
                    {{ Form::close() }}

                    @endif

                </div>
            </li>
        </div>
        @endforeach
    </ul>
</div>
<br>
<div class="card-body" Style='border:0.5px solid #DCDCDC;background:#F0F0F0;border-radius:15px;'>
    <h2><strong>Add another answer : </strong></h2>
    {{Form::open(['route'=>'addanswers.store','method'=>'POST'])}}
    {{Form::textarea('saveanswer','Insert new answer here',['class'=>'form-control textarea','rows'=>'1'])}}
    {{Form::hidden('question_id',$question->id)}}
    <br>
    {{Form::submit('Add answer',['class'=>'btn  btn-primary'])}}                      
    {{ Form::close() }}
   
    @if($question->question_nr != NULL)
    <h2><a href="/{{$quizname}}">Return to {{$quizname}}</a></h2>
    @else
    <h2><strong>Don't forget to add the correct answer by clicking  on the <button class="btn btn-success">Correct</button> button .</strong></h2>
     @endif
</div> 

@endsection


