@extends('layouts.app')

@section('content')

<div class="card-body">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif

</div>

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
                <div class="col-sm-8 col-md-8 col-xs-8">  <h3><span class="badge badge-success" id="">{{$indexKey+1}}.</span>
                        <strong>&nbsp {{$question->body}}</strong></h3>      

                </div>

                <div  class="col-sm-2 col-md-2  col-xs-2 btn-sm">
                    {{ Form::open(['method' => 'DELETE', 'route' => ['delquestion.delete', $question->id]]) }}
                    {{ Form::submit('Delete question',['class'=>'btn btn-danger '])}} 
                    {{ Form::close() }}
                </div>
                <div  class="col-sm-1 col-md-1  col-xs-1 btn-sm">
                    <a href="{{route('addanswerstoquestion', ['question' => $question->id])}}" class="btn btn-success ">Add answer</a>
                </div>
            </li>

        </div> 

        <ul class="list-group" >

            @foreach($question->Answers() as $indexKey2=>$answer)
            <div  class="list-group-item">
                <li class="row"> 

                    <div class="col-sm-9 col-md-9 col-xs-9"><h4>{{$indexKey2+1}}. {{$answer->body}}</h4>

                    </div>

                    <div  class="col-sm-1 col-md-1  col-xs-1 btn-sm">
                        {{ Form::open(['method' => 'DELETE', 'route' => ['delanswer.delete', $answer->id]]) }}
                        {{Form::submit('Delete',['class'=>'btn btn-danger '])}} 
                        {{ Form::close() }}

                    </div>
                    @if($question->question_nr != $answer->id)
                    <div  class="col-sm-1 col-md-1 btn-sm">
                        {{ Form::open(['method' => 'PUT', 'route' => ['correctanswer.update', $question->id]]) }}
                        {{Form::hidden('answerid',$answer->id)}}
                        {{Form::submit('Correct',['class'=>'btn btn-success '])}} 
                        {{ Form::close() }}
                    </div>
                    @endif

                </li>
            </div>
            @endforeach
        </ul>




        <br>
        @endforeach
    </div>  

    <div class=" col-sm-4">        
        <p><a href="/{{$quiz->name}}/CreateQuestion">Add question</a></p>
    </div>
</ul>


@endsection