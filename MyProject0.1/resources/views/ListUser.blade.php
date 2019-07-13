@extends('layouts.app')

@section('content')

<h2>
    <div class="row">
        <div class="col-md-9 col-xs-9 col-sm-9 ">
            List of Users from    
            <div class="dropdown">
                <a class="dropdown-toggle btn btn-lg btn-default" thref="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><strong>{{$location}}</strong>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="/ALL/ListUsers" >All</a>
                    <a class="dropdown-item" href="/SXB/ListUsers" >SXB</a>
                    <a class="dropdown-item" href="/FRA/ListUsers" >FRA</a>
                    <a class="dropdown-item" href="/STL/ListUsers" >STL</a>
                    <a class="dropdown-item" href="/Leeds/ListUsers" >Leeds</a>
                    <a class="dropdown-item" href="/AMS/ListUsers" >AMS</a>
                </div>
            </div> :

        </div>

        <div class="col-md-3 col-xs-3 col-sm-3 ">
            <form action="{{ route('search') }}" method="Get" role="search">
                @csrf
                <div class="input-group">
                    <input type="text" class="form-control" name="name"
                           placeholder="Search users"> 
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-default">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </span>        
                </div>
            </form>
        </div>
    </div>
</h2>


<ul class="list-group" >
    @foreach($guestusers as $indexKey =>$guestuser)
    <div class="row">
        <li class=" list-group-item col-md-12 col-xs-12 col-sm-12 container">
            <h3>{{$indexKey + 1}}. {{$guestuser->email}} </h3>

            <div class="row">
                <div class="col-md-8 col-xs-8 col-sm-8">
                    <p>Is assigned to : </p>
                    <br>
                </div>
                <div class="col-md-4 col-xs-4 col-sm-4">

                    <form action="{{ route('assignedquiz.store')}}" method="POST" class="form-horizontal">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-xs-6 col-sm-6">
                                <select class="form-control" name="QuizID">

                                    <option>Select quiz</option>

                                    @foreach($quizzes as $quiz)
                                    
                                    <option value="{{ $quiz->id }}" >{{ $quiz->title }} (URL: {{ $quiz->name }}) </option>
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
            <div class="row">
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <ul class="list-group m-0 p-0" >
                        @foreach($guestuser->assignedq() as $assigned)
                        <li  class="list-group-item " >
                            <div class="row">
                                <div class="col-md-9 col-xs-9 col-sm-9">
                                    <strong>{{ $assigned->quiz->name }} (</strong> {{ $assigned->code }}<strong> )</strong> @if($assigned->grade>0)<strong> Grade: </strong>{{ $assigned->grade }}% -> <a href='/grade/{{$assigned->code}}'>Check results</a>@endif
                                    Time: <strong>{{$assigned->time}}</strong> min 
                                </div>
                                <div class="col-md-2 col-xs-2 col-sm-2">
                                    <form action='/UpdateTime' method="POST" >
                                        {{ csrf_field() }}
                                       
                                        <input type="text" id="time" name="time" maxlength="6" size="6" value="{{$assigned->time}} min">
                                        <input type="hidden" id="code" name="code" value="{{$assigned->code}}" >
                                        <button type="submit" class="btn btn-info">
                                            Save
                                        </button>
                                    </form>
                                    </div>
                                  <div class="col-md-1 col-xs-1 col-sm-1">
                                    {{ Form::open(['method' => 'DELETE', 'route' => ['delassignedquiz.delete', $guestuser->id,$assigned->quiz->id]]) }}
                                    {{ Form::submit('Delete',['class'=>'btn btn-danger'])}} 
                                    {{ Form::close() }}
                                  </div>  
                                
                            </div>
                        </li>
                        @endforeach                  
                    </ul>
                </div>
            </div>
        </li>
    </div>
    <br>
    @endforeach
</ul>

<h2>Questionary list :</h2>
<br>
<div class="row">
    <table  class="table table-bordered col-md-12 col-xs-12 col-sm-12 ">
        <thead  class="thead-light ">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Title</th>
                <th scope="col">Created</th>
                <th scope="col"></th>
            </tr>
        </thead>

        <tbody>
            @foreach($quizzes as $indexKeyQ =>$quiz)           
            <tr>
                <th scope="row">{{$indexKeyQ + 1}}.</th>
                <td scope="row">{{$quiz->name}} </td>
                <td scope="row">{{$quiz->title}} </td> 
                <td scope="row">{{$quiz->created_at}} </td> 
                <td scope="row">  <a href="/edit/{{$quiz->name}}" class="btn btn-success ">Edit</a> </td> 

            </tr>
            @endforeach

        </tbody>
    </table>
</div>

@endsection
