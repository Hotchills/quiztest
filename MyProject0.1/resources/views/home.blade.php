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
        <ul class="list-group">
            @foreach($quizzes as $quiz)
            <div  class="list-group-item">
                <li class="row"> 

                    <div class="col-sm-9 col-md-9 col-xs-9">
                        <h2><a href="/{{$quiz->name}}">{{$quiz->title}}</a></h2>

                    </div>
                    <div  class="col-sm-1 col-md-1  col-xs-1 btn-sm">
                        {{ Form::open(['method' => 'DELETE', 'route' => ['delquiz.delete', $quiz->id]]) }}
                        {{Form::submit('Delete',['class'=>'btn btn-danger '])}} 
                        {{ Form::close() }}

                    </div>
                    <div  class="col-sm-1 col-md-1  col-xs-1 btn-sm"> 
                        <div class=" col">          
                            <a href="/edit/{{$quiz->name}}" class="btn btn-success ">Edit</a>
                        </div>
                    </div>
                </li>


            </div>
            @endforeach
        </ul>
    </div>
   <div class="container">
     <a href="/CreateGuestUser" class="btn btn-success">Create User</a>
        <a href="/ListUser" class="btn btn-info ">Assign User to Quiz</a>
        
        
    <button type="button" class="btn btn-warning" value="Input Button" onclick="makenewquiz()">Add quiz</button>
</div>
</div>

    <script>
    function makenewquiz() {

        location.href = "{{route('CreateQuiz')}}";
    }
</script>


@endsection
