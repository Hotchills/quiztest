@extends('layouts.app')

@section('content')

<div class="container" Style="width:400px;">

{{Form::open(['route'=>'loginguestuser.show','method'=>'POST'])}}

{{Form::label('code','Insert Code')}}
{{Form::text('code','',['class'=>'form-control'])}}



{{Form::submit('Start Test',['class'=>'btn btn-success'])}}

{{ Form::close() }}


</div>
@endsection
