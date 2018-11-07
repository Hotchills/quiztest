@extends('layouts.app')

@section('content')
<style>
    body, html{
        height: 100%;
        background-repeat: no-repeat;
        background-color: #d3d3d3;
        font-family: 'Oxygen', sans-serif;
    }

    .main{
        margin-top: 70px;
    }

    h1.title { 
        font-size: 50px;
        font-family: 'Passion One', cursive; 
        font-weight: 400; 
    }

    hr{
        width: 10%;
        color: #fff;
    }

    .form-group{
        margin-bottom: 15px;
    }

    label{
        margin-bottom: 15px;
    }

    input,
    input::-webkit-input-placeholder {
        font-size: 11px;
        padding-top: 3px;
    }

    .main-login{
        background-color: #fff;
        /* shadows and rounded borders */
        -moz-border-radius: 2px;
        -webkit-border-radius: 2px;
        border-radius: 2px;
        -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);

    }

    .main-center{
        margin-top: 30px;
        margin: 0 auto;
        max-width: 330px;
        padding: 40px 40px;

    }

    .login-button{
        margin-top: 5px;
    }

    .login-register{
        font-size: 11px;
        text-align: center;
    }


</style>
<div class="container card" Style="width:50%;width-min:200px;height:400px; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">

    <div class="row  ">
        <div class="col-md-12">
            <div class=" text-center">
                <br>
                <h1>Please insert the code below:</h1>
            </div>
            <br>
        </div>
        <div class="col-md-12 text-center">
            {{Form::open(['route'=>'loginguestuser.show','method'=>'POST'])}}


            {{Form::text('code','',['class'=>'form-control'])}}
<br>
            {{Form::submit('Start Test',['class'=>'btn btn-success text-center btn-lg'])}}

            {{ Form::close() }}

        </div>
    </div>
</div>




@endsection
