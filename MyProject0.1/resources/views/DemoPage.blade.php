@extends('layouts.app')

@section('content')


<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
    <li><a data-toggle="tab" href="#menu0">Page 1</a></li>
    <li><a data-toggle="tab" href="#menu1">Page 2</a></li>
    <li><a data-toggle="tab" href="#menu2">Page 3</a></li>
    <li><a data-toggle="tab" href="#menu3">Page 4</a></li>
    <li><a data-toggle="tab" href="#menu4">Page 5</a></li>
    <li><a data-toggle="tab" href="#menu5">Page 6</a></li>
    <li><a data-toggle="tab" href="#menu6">Page 7</a></li>
</ul>
<br>

<div class="tab-content">
    <div id="home" class="tab-pane fade in active container">
        <ul >
            <li><h2 >Page 1</h2>
                <h4>The first step is creating a new test. If you already have a test and just want to assign it to a user skip to Page5</h4>


            </li>
            <li><h2 >Page 2</h2>
                <h4>The second step is adding new questions to the test. </h4>
            </li>
            <li><h2 >Page 3</h2>
                <h4>The third step is adding answers to the questions and selecting the correct answers. </h4>
            </li>
            <li><h2 >Page 4</h2>
                <h4>This page allows you to see the existing tests, and eventually edit one. </h4>
            </li>
            <li><h2 >Page 5</h2>
                <h4>Here you can create a new user with an individual id - user that is about to take the test. </h4>
            </li> 
            <li><h2 >Page 6</h2>
                <h4>Here you can find listed all the users created, arranged by DC. A test can be assigned by the selector "Select quiz", you will get a randomly generated code for the end user to start the test. On this page, you can change the time for a test and also see the results.</h4>
            </li>
            <li><h2 >Page 7</h2>           
                <h4>You can start a short demo. Click on the Start Test to begin it. </h4>
            </li>
        </ul>
    </div>

    <div id="menu0" class="tab-pane fade">

        <h3> Create Test :</h3>

        <div class="container" Style="width:50%;">
            <h2>Add new quiz</h2>

            {{Form::label('name','This is the URL(only alpha-numeric characters):')}}
            {{Form::text('name','',['class'=>'form-control'])}}

            {{Form::label('title','Title:')}}
            {{Form::text('title','Title',['class'=>'form-control'])}}

            {{Form::label('body','Details:')}}
            {{Form::textarea('body','Details',['class'=>'form-control textarea','rows'=>'7'])}}
            <br>
            {{Form::button('Add quiz',['class'=>'btn btn-success'])}}

        </div>      

    </div>
    <div id="menu1" class="tab-pane fade"> 
        <h2>Create questions for the test:</h2>

        <div class="card-body" Style='border:0.5px solid #DCDCDC;background:#F0F0F0;border-radius:15px;'>

            <h2>Add new question</h2>

            {{Form::text('type','Type',['class'=>'form-control'])}}

            {{Form::textarea('body','Body',['class'=>'form-control textarea','rows'=>'4'])}}

            {{Form::submit('Add question',['class'=>'btn btn-primary'])}}

            <h2><a href="#">Return to Test</a></h2>

        </div>
    </div>
    <div id="menu2" class="tab-pane fade">
        <h2> Add answers to the test </h2>


        <div class="card-body" Style='border:0.5px solid #DCDCDC;background:#F0F0F0;border-radius:15px;'>

            <h2> <strong>Demo Question Title</strong></h2>
            <p>Question body :<strong> Demo Body </strong></p>
            <h2><strong>Answers for this question:</strong> </h2>
            <ul class="list-group" >

                @for($i = 0; $i < 4; $i++)
                <div  class="list-group-item">
                    <li class="row"> 
                        <div class="col-sm-9 col-md-9 col-xs-9"><h3>Demo Answer {{$i}}</h3>
                        </div>

                        <div  class="col-sm-1 col-md-1  col-xs-1 btn-sm">

                            {{Form::submit('Delete',['class'=>'btn btn-danger '])}} 

                        </div>

                        <div  class="col-sm-1 col-md-1 btn-sm">



                            {{Form::submit('Correct',['class'=>'btn btn-success '])}} 


                        </div>
                    </li>
                </div>
                @endfor
            </ul>
        </div>
        <br>
        <div class="card-body" Style='border:0.5px solid #DCDCDC;background:#F0F0F0;border-radius:15px;'>
            <h2><strong>Add another answer : </strong></h2>

            {{Form::textarea('saveanswer','Insert new answer here',['class'=>'form-control textarea','rows'=>'1'])}}

            <br>
            {{Form::submit('Add answer',['class'=>'btn  btn-primary'])}}                      

            <h2><strong>Don't forget to add the correct answer by clicking  on the <button class="btn btn-success">Correct</button> button .</strong></h2>

        </div> 
    </div>
    <div id="menu3" class="tab-pane fade">

        <h3> Check existing tests and edit them :</h3>

        <div class="card ">
            <div class="card-header">Dashboard</div>

            <div class="card-body ">
                <h2>Available Questionary: </h2>
                <ul class="list-group ">
                    @for($i = 0; $i < 4; $i++)
                    <br>
                    <div  class="list-group-item "Style="background: #F0F0F0;border:0.5px solid #DCDCDC; border-radius: 12px;">
                        <li class="row "> 
                            <div class="col-sm-9 col-md-9 col-xs-9">
                                <h2><a href="#">Demo Title {{$i}}</a></h2>

                            </div>
                            <div  class="col-sm-1 col-md-1  col-xs-1 btn-sm">                    
                                {{Form::submit('Delete',['class'=>'btn btn-danger '])}} 

                            </div>
                            <div  class="col-sm-1 col-md-1  col-xs-1 btn-sm"> 
                                <div class=" col">          
                                    <a href="#" class="btn btn-success ">Edit</a>
                                </div>
                            </div>
                        </li>

                    </div>
                    @endfor
                </ul>
            </div>

        </div>
    </div>
    <div id="menu4" class="tab-pane fade" >
        <h3>Create a user : </h3>

        <div class="container"Style="width:50%;">

            <h2>Add new User </h2>


            {{Form::label('email','User ID code: ')}}
            {{Form::text('email','',['class'=>'form-control'])}}
            <br>
            {{Form::select('location', array('Default' => 'Please Select a DC','SXB' => 'SXB','FRA' => 'FRA', 'STL' => 'STL', 'Leeds' => 'Leeds', 'AMS' => 'AMS'), 'Default', ['class' => 'form-control'])}}

            <br>
            {{Form::submit('Add User',['class'=>'btn btn-success'])}}

        </div>

    </div>
    <div id="menu5" class="tab-pane fade">
        <h3>Assign user to Test and get a random generated code: </h3>

        <h2>
            List of Users from    <div class="dropdown">
                <a class="dropdown-toggle btn btn-lg btn-default" thref="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><strong>DC</strong>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="/ALL/ListUser" >All</a>
                    <a class="dropdown-item" href="/SXB/ListUser" >SXB</a>
                    <a class="dropdown-item" href="/FRA/ListUser" >FRA</a>
                    <a class="dropdown-item" href="/STL/ListUser" >STL</a>
                    <a class="dropdown-item" href="/Leeds/ListUser" >Leeds</a>
                    <a class="dropdown-item" href="/AMS/ListUser" >AMS</a>
                </div>
            </div> :
        </h2>

        <ul class="list-group" >
            @for($i = 0; $i < 2; $i++)
            <div class="row">
                <li class=" list-group-item col-md-12 col-xs-12 col-sm-12 container">
                    <h3>{{$i + 1}}. Demo User {{$i}} </h3>

                    <div class="row">
                        <div class="col-md-8 col-xs-8 col-sm-8">
                            <p>Is assigned to : </p>
                        </div>
                        <div class="col-md-4 col-xs-4 col-sm-4">

                            <form  class="form-horizontal">
                                <div class="row">
                                    <div class="col-md-6 col-xs-6 col-sm-6">
                                        <select class="form-control" >

                                            <option>Select quiz</option>

                                            @for($j = 0; $j < 6; $j++)
                                            <option > Demo Test {{$j}} </option>
                                            @endfor   
                                        </select>
                                    </div>
                                    <div class="col-md-5 col-xs-5col-sm-5">

                                        <button class="btn btn-success">
                                            Assign
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-md-12 col-xs-12 col-sm-12">
                            <ul class="list-group" >
                                @for($j = 0; $j < 3; $j++)
                                <li  class="list-group-item " >
                                    <div class="row">
                                        <div class="col-md-8 col-xs-8 col-sm-8">
                                            <strong>Demo Test {{$j}} (</strong> "code"<strong> )</strong> 
                                            Time: <strong>30</strong> min 
                                        </div>
                                        <div class="col-md-4 col-xs-4 col-sm-4">
                                            <form >

                                                <input type="text"  maxlength="6" size="6" value="30 min">
                                                <button type="submit" class="btn btn-info">
                                                    Save
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                                @endfor                 
                            </ul>
                        </div>
                    </div>
                </li>
            </div>
            <br>
            @endfor
        </ul>
    </div>
    <div id="menu6" class="tab-pane fade">
        <h3>The code from Page6 can be used on the front page to login. Click on "Start Test" to begin a Demo</h3>


        <div Style="background: #02C54C;padding: 10%;">        

            <div class="container card" Style="width:350px;width-min:200px;height:400px; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">

                <div class="row  ">
                    <div class="col-md-12">

                        <br>
                    </div>
                    <div class="col-md-12 text-center">
                        {{Form::label('code','Insert Code:')}}
                        {{Form::text('code','8mLjm9TAQMtvQvA',['class'=>'form-control'])}}
                        <br>
                        <a class="btn btn-warning text-center btn-lg" href="/Thisisademocode/demotest/StartTestPage">Start Test</a> 
                    </div>
                </div>
            </div>

        </div>     
    </div>
</div>
@endsection