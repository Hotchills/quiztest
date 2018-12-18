@extends('layouts.app')

@section('content')




<h2>Add new User </h2>

{{Form::open(['route'=>'guestuser.store','method'=>'POST'])}}

{{Form::label('email','Workday Number')}}
{{Form::text('email','',['class'=>'form-control'])}}
{{Form::select('location', array('Default' => 'Please Select A DC','SXB' => 'SXB','FRA' => 'FRA', 'STL' => 'STL', 'Leeds' => 'Leeds', 'AMS' => 'AMS'), 'Default', ['class' => 'form-control'])}}


{{Form::submit('Add User',['class'=>'btn btn-primary'])}}

{{ Form::close() }}

<br>
<a href="/ListUser">ListGuestUsers</a>


@endsection
