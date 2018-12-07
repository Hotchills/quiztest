@extends('layouts.app')

@section('content')


<div class="card-header">
    <h1>Name: <strong> {{$quiz->name}}</strong></h1>
    <h1>{{$quiz->title}}</h1>
    <p>Debug info quizID: <strong>{{$quiz->id}}</strong></p> 
</div>


<ul class="card-body" Style="list-style: none;border:0.5px green solid;">
    <div class="list-group">
        @foreach($questions as $indexKey=> $question)
        <div  class="list-group-item list-group-item-success">
            <li class="row">
                <div class="col-sm-10 col-md-10 col-xs-10"> 
                    <h3 id="EditQuestionText{{$question->id}}" >
                        <span class="badge badge-success" id="">{{$indexKey+1}}.</span>
                        &nbsp  {{$question->body}}  ($question->id)</h3> 
                    <h3 id="EditQuestionTextForm{{$question->id}}" Style="display:none;">
                        {{ Form::open(['method' => 'PUT', 'route' => ['question.update']]) }}
                        {{Form::hidden('questionID',$question->id)}}
                        {{ Form::textarea('questionBODY',$question->body,['class'=>'form-control textarea','rows'=>'1'])}}
                        {{ Form::submit('Save',['class'=>'btn btn-warning'])}} 

                        <a  id="CancelEditQuestionButton{{$question->id}}" class="btn btn-primary" onclick="QuestionCancelEdit({{$question->id}})">Cancel</a>  

                        {{ Form::close() }}
                    </h3>     

                </div>
                <div class="col-sm-1 col-md-1 col-xs-1"> 
                    <div class="dropdown">
                        <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown">Options
                            <span class="caret"></span></button>
                        <ul class="dropdown-menu" >
                            <li>   <a href="{{route('addanswerstoquestion', ['question' => $question->id])}}" class="btn btn-success " Style="width:100%;border:0px;border-radius:0px;">Add answer</a>
                            </li>
                            <li> {{ Form::open(['method' => 'DELETE', 'route' => ['delquestion.delete', $question->id]]) }}
                                {{ Form::submit('Delete question',['class'=>'btn btn-danger btn-dropdown btn-fordropdown'])}} 
                                {{ Form::close() }}</li>
                            <li> 
                                <a  id="EditQuestionButton{{$question->id}}" class="btn btn-primary btn-fordropdown" onclick="QuestionEdit({{$question->id}})">Edit</a>  
                            </li>

                        </ul>
                    </div>
                </div>
            </li>

        </div> 

        <ul class="list-group" >

            @foreach($question->Answers() as $indexKey2=>$answer)
            <div  class="list-group-item">
                <li class="row"> 

                    <div class="col-sm-9 col-md-9 col-xs-8">
                        <h4 id="EditAnswerText{{$answer->id}}" >{{$indexKey2+1}}. {{$answer->body}}</h4>

                        <h4 id="EditAnswerTextForm{{$answer->id}}" Style="display:none;">

                            {{ Form::open(['method' => 'PUT', 'route' => ['answer.update']]) }}
                            {{Form::hidden('answerID',$answer->id)}}
                            {{ Form::textarea('answerBODY',$answer->body,['class'=>'form-control textarea','rows'=>'1'])}}
                            {{ Form::submit('Save',['class'=>'btn btn-warning'])}} 

                            <a class="btn btn-primary" onclick="AnswerCancelEdit({{$answer->id}})">Cancel</a>  
                            {{ Form::close() }}

                        </h4>
                    </div>

                    <div  class="col-sm-2 col-md-2 col-xs-2 btn-sm">
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


                    <div  class="col-sm-1 col-md-1 col-xs-1 btn-sm">
                        <div class="dropdown">
                            <button class="btn btn-info dropdown-toggle" type="button" id="menuanswer{{$answer->id}}" data-toggle="dropdown">
                                <span class="caret"></span></button>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="menuanswer{{$answer->id}}">
                                <li role="presentation"><a role="menuitem" >
                                        {{ Form::open(['method' => 'DELETE', 'route' => ['delanswer.delete', $answer->id]]) }}
                                        {{ Form::submit('Delete',['class'=>'btn btn-danger btn-fordropdown'])}} 
                                        {{ Form::close() }}
                                    </a>
                                </li>
                                <li role="presentation"><a role="menuitem"   id="EditAnswerButton{{$answer->id}}" class="btn btn-primary btn-fordropdown"  onclick="AnswerEdit({{$answer->id}})">Edit</a>
                                </li>
                            </ul>
                        </div>
                    </div>


                </li>
            </div>
            @endforeach
        </ul>

        <br>
        @endforeach
    </div>  

    <div class=" col-sm-4">        
        <p><a  class="btn btn-success" href="/{{$quiz->name}}/CreateQuestion">Add new question</a></p>
    </div>
</ul>

<script>
    function QuestionEdit(temp) {
    document.getElementById('EditQuestionButton' + temp).style.display = "none";
    document.getElementById('EditQuestionTextForm' + temp).style.display = "block";
    document.getElementById('EditQuestionText' + temp).style.display = "none";
    }
    function QuestionCancelEdit(temp) {
    document.getElementById('EditQuestionButton' + temp).style.display = "block";
    document.getElementById('EditQuestionTextForm' + temp).style.display = "none";
    document.getElementById('EditQuestionText' + temp).style.display = "block";
    }

    function AnswerEdit(temp) {
    document.getElementById('EditAnswerButton' + temp).style.display = "none";
    document.getElementById('EditAnswerTextForm' + temp).style.display = "block";
    document.getElementById('EditAnswerText' + temp).style.display = "none";
    }
    function AnswerCancelEdit(temp) {
    document.getElementById('EditAnswerButton' + temp).style.display = "block";
    document.getElementById('EditAnswerTextForm' + temp).style.display = "none";
    document.getElementById('EditAnswerText' + temp).style.display = "block";
    }


</script>
@endsection