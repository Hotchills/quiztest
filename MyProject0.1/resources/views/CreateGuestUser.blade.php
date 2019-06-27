@extends('layouts.app')

@section('content')


<div class="container">

<h2>Add new User </h2>

{{Form::open(['route'=>'guestuser.store','method'=>'POST'])}}

{{Form::label('email','Workday Number')}}
{{Form::text('email','',['class'=>'form-control'])}}
<br>
{{Form::select('location', array('Default' => 'Please Select a DC','SXB' => 'SXB','FRA' => 'FRA', 'STL' => 'STL', 'Leeds' => 'Leeds', 'AMS' => 'AMS'), 'Default', ['class' => 'form-control'])}}

<br>
{{Form::submit('Add User',['class'=>'btn btn-success'])}}

{{ Form::close() }}

<br>
<a href="/home">Home</a>

</div>
@endsection
