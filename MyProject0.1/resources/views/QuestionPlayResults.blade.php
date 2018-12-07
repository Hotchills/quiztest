@extends('layouts.app')

@section('content')


<div class="quiz-box card">
    <div class="card-header">

    </div>
    <ul class="card-body" Style="list-style: none;">
        <div class="question-box">
            <h1> <strong>{{$question->id}}.</strong> {{$question->body}} </strong></h1>

            <li><h3><span class="badge badge-success" ></span><strong></strong></h3>
            </li>
            <br>
            <ul class="list-group row" >
                @foreach($question->Answers() as  $key=>$answer )

                <li class="list-group-item"> {{  $answer->body }} </li>

                @endforeach

                <br>
            </ul>
        </div>

    </ul>

    <br>
    
  <ul class="container list-group" >

    @foreach($plays as $indexKey =>$play)
    <div class="row">
        <li class="list-group-item col-md-12 col-xs-12 col-sm-12">
            <h3>{{$indexKey+1}}. {{$play->name}} : {{$play->info_string}} </h3>
<p>INFO: {{$play->body}}</p>

        </li>
    </div>
    <br>
    @endforeach

</ul>
  
</div>



@endsection
