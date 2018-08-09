@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                <h1>{{$quiz->name}}</h1>
                <h1>{{$quiz->title}}</h1>
                <h1>{{$quiz->id}}</h1>
                </div>
                <ul class="card-body">
                  @foreach($quiz->QuestionPaginate() as $question)
<div Style="border:3px solid #00a63f ;margin:10px;border-radius:5px;padding:25px; ">

<li><h3><strong>{{$question->title}}</h3>
  <hr>
    {{Form::open(['route'=>'useranswer.store','method'=>'POST'])}}
    {{Form::textarea('answer','Answer',['class'=>'form-control textarea','rows'=>'4'])}}
    {{Form::hidden('question_id',$question->id)}}
    {{Form::hidden('user_id',0)}}
    {{Form::submit('Submit',['class'=>'btn btn-success'])}}
    {{ Form::close() }}
</li>

</div>
                  @endforeach
{{ $quiz->QuestionPaginate()->links() }}
</ul>

<button type="button" class="btn btn-success" value="Input Button" onclick="makenewquestion()" >Add question to quiz</button>
</div>
</div>
</div>
</div>
<script>
function makenewquestion(){

location.href = "{{route('CreateQuestion',['main' => $quiz->name ])}}";
}
</script>

@endsection
