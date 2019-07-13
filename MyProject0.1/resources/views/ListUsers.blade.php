@extends('layouts.app')

@section('content')


<br>

<h2>
    <div class=" row">
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
<div class="row">
    <table  class="table table-striped table-bordered col-md-12 col-xs-12 col-sm-12 ">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Location</th>
                <th scope="col">Created</th>
                <th scope="col"></th>
            </tr>
        </thead>

        <tbody>

            @foreach($guestusers as $indexKey =>$guestuser)
            <tr>
                <th scope="row">{{$indexKey + 1}}.</th>
                <td scope="row">{{$guestuser->email}} </td>
                <td scope="row">{{$guestuser->info1}} </td>
                <td scope="row">{{$guestuser->created_at}} </td>
                <td scope="row"> <a class="btn btn-success" href="/{{$guestuser->id}}/ListUser">Edit </a>           
                </td>

            </tr>
            @endforeach

        </tbody>
    </table>
</div>
<h2>Questionary list :</h2>
<br>


<div class="row">
    <table  class="table table-bordered table-sm col-md-12 col-xs-12 col-sm-12 ">
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
