@extends('layouts.app')

@section('content')


<h2>List of Users :</h2>
<br>
<ul class="list-group row" >
    @foreach($guestusers as $guestuser)

    <li class="list-group-item"><h3>{{$guestuser->id}}. {{$guestuser->email}} </h3>

        <p>Is assigned to : </p>
        @foreach($guestuser->assignedq() as $assigned)
        <ul>
            
       
      <li><strong> ID:</strong>{{ $assigned->quiz_id }}<strong> CODE: </strong>{{ $assigned->code }}</li>
 </ul>
        @endforeach

        <div class="row">
            


                <form action='/AssignedQuiz' method="POST" class="form-horizontal">
                    {{ csrf_field() }}


                    <select class="form-control" name="QuizID">

                        <option>Select quiz</option>

                        @foreach($quizzes as $quiz)
                        <option value="{{ $quiz->id }}" > {{ $quiz->name }} </option>
                        @endforeach    
                    </select>

                    <input type="hidden" id="guestuserid" name="guestuserid" value="{{$guestuser->id}}">
                   
                    
                        <button type="submit" class="btn btn-default">
                            Assign
                        </button>
                   
                </form>
            </div>

    </li>
    <br>
    @endforeach

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
