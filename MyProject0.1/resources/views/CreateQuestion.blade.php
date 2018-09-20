@extends('layouts.app')

@section('content')





<h2>Add new question</h2>

{{Form::open(['route'=>'question.store','method'=>'POST'])}}


{{Form::text('type','Type',['class'=>'form-control'])}}



{{Form::hidden('id',$quiztempid)}}



{{Form::textarea('body','Body',['class'=>'form-control textarea','rows'=>'4'])}}



{{Form::submit('Add question',['class'=>'btn btn-primary'])}}


{{ Form::close() }}

<script>

</script>
@endsection
