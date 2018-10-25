@extends('layouts.app')

@section('content')




<h2>Add new User </h2>

{{Form::open(['route'=>'guestuser.store','method'=>'POST'])}}

{{Form::label('email','Email')}}
{{Form::text('email','',['class'=>'form-control'])}}

{{Form::label('password','password')}}
{{Form::text('password','password',['class'=>'form-control'])}}


{{Form::submit('Add User',['class'=>'btn btn-primary'])}}

{{ Form::close() }}

<br>
<a href="/ListUser">ListGuestUsers</a>


@endsection
