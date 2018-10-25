@extends('layouts.app')

@section('content')



{{Form::open(['route'=>'loginguestuser.show','method'=>'POST'])}}

{{Form::label('code','Insert Code')}}
{{Form::text('code','',['class'=>'form-control'])}}



{{Form::submit('Start Test',['class'=>'btn btn-primary'])}}

{{ Form::close() }}



@endsection
