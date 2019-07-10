@extends('layouts.app')

@section('content')


<br>
<h2>
    List of Users from    <div class="dropdown">
    <a class="dropdown-toggle btn btn-lg btn-default" thref="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><strong>{{$location}}</strong>
    </a>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="/ALL/ListUser" >All</a>
      <a class="dropdown-item" href="/SXB/ListUser" >SXB</a>
      <a class="dropdown-item" href="/FRA/ListUser" >FRA</a>
      <a class="dropdown-item" href="/STL/ListUser" >STL</a>
      <a class="dropdown-item" href="/Leeds/ListUser" >Leeds</a>
      <a class="dropdown-item" href="/AMS/ListUser" >AMS</a>
    </div>
  </div> :
</h2>

<ul class="list-group" >
    @foreach($guestusers as $indexKey =>$guestuser)
    <div class="row">
        <li class=" list-group-item col-md-12 col-xs-12 col-sm-12 container">
            <h3>{{$indexKey + 1}}. {{$guestuser->email}} </h3>

            <div class="row">
                <div class="col-md-8 col-xs-8 col-sm-8">
                    <p>Is assigned to : </p>
                </div>
                <div class="col-md-4 col-xs-4 col-sm-4">

                    <form action='/AssignedQuiz' method="POST" class="form-horizontal">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6 col-xs-6 col-sm-6">
                                <select class="form-control" name="QuizID">

                                    <option>Select quiz</option>

                                    @foreach($quizzes as $quiz)
                                    
                                    <option value="{{ $quiz->id }}" >{{ $quiz->title }} (URL: {{ $quiz->name }}) </option>
                                    @endforeach    
                                </select>
                            </div>
                            <div class="col-md-5 col-xs-5 col-sm-5">
                                <input type="hidden" id="guestuserid" name="guestuserid" value="{{$guestuser->id}}">
                                <button type="submit" class="btn btn-success">
                                    Assign
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div> 
            <div class="row">
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <ul class="list-group" >
                        @foreach($guestuser->assignedq() as $assigned)
                        <li  class="list-group-item " >
                            <div class="row">
                                <div class="col-md-8 col-xs-8 col-sm-8">
                                    <strong>{{ $assigned->quiz->name }} (</strong> {{ $assigned->code }}<strong> )</strong> @if($assigned->grade>0)<strong> Grade: </strong>{{ $assigned->grade }}% -> <a href='/grade/{{$assigned->code}}'>Check results</a>@endif
                                    Time: <strong>{{$assigned->time}}</strong> min 
                                </div>
                                <div class="col-md-2 col-xs-2 col-sm-2">
                                    <form action='/UpdateTime' method="POST" >
                                        {{ csrf_field() }}
                                       
                                        <input type="text" id="time" name="time" maxlength="6" size="6" value="{{$assigned->time}} min">
                                        <input type="hidden" id="code" name="code" value="{{$assigned->code}}" >
                                        <button type="submit" class="btn btn-info">
                                            Save
                                        </button>
                                    </form>
                                    </div>
                                  <div class="col-md-2 col-xs-2 col-sm-2">
                                    {{ Form::open(['method' => 'DELETE', 'route' => ['delassignedquiz.delete', $guestuser->id,$assigned->quiz->id]]) }}
                                    {{ Form::submit('Delete',['class'=>'btn btn-danger btn-dropdown btn-fordropdown'])}} 
                                    {{ Form::close() }}
                                  </div>  
                                
                            </div>
                        </li>
                        @endforeach                  
                    </ul>
                </div>
            </div>
        </li>
    </div>
    <br>
    @endforeach
</ul>

<h2>Test list :</h2>
<br>
<ul class="list-group row" >
    @foreach($quizzes as $quiz)

    <li Style="background:#E8E8E8;" class="list-group-item"><h3>{{$quiz->id}}. {{$quiz->body}}</h3></li>

    @endforeach

    <br>

</ul>

@endsection
