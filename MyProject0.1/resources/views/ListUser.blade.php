@extends('layouts.app')

@section('content')


<h2>List of Users :</h2>
<br>
<ul class="list-group" >

    @foreach($guestusers as $indexKey =>$guestuser)
    <div class="row">
        <li class="list-group-item col-md-12 col-xs-12 col-sm-12">
            <h3>{{$guestuser->id}}. {{$guestuser->email}} </h3>

            <div class="row">

                <div class="col-md-8 col-xs-8 col-sm-8">

                    <p>Is assigned to : </p>
                    <ul class="list-group" >
                        @foreach($guestuser->assignedq() as $assigned)
                        <li  class="list-group-item" ><strong>{{ $assigned->quiz->name }} (</strong> {{ $assigned->code }}<strong> )</strong> @if($assigned->grade>0)<strong> Grade: </strong>{{ $assigned->grade }}% -> <a href='/grade/{{$assigned->code}}'>Check results</a>@endif</li>
                        @endforeach                  
                    </ul>

                </div>
                <div class="col-md-4 col-xs-4 col-sm-4">

                    <form action='/AssignedQuiz' method="POST" class="form-horizontal">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6 col-xs-6 col-sm-6">
                                <select class="form-control" name="QuizID">

                                    <option>Select quiz</option>

                                    @foreach($quizzes as $quiz)
                                    <option value="{{ $quiz->id }}" > {{ $quiz->name }} </option>
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
        </li>
    </div>
    <br>
    @endforeach

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
