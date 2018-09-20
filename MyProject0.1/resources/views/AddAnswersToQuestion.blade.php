@extends('layouts.app')

@section('content')

<div class="card-body">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif

</div>

<div class="card-body">


    <h2>Quiz : {{$question->type}}</h2>
    <p> {{$question->body}} </p>


</div>


<p> Add answers : </p>

<input class="form-control" id="addanswers" type="text" />
<button class="btn btn-primary" id="addanswersbutton"value="addanswersbutton" name="addanswersbutton" >AddAnswer</button>


<!-- Content here -->
<ul class="row container-fluid" id="show-answers">

</ul> 

<script>
    $(document).ready(function () {

        var array = $();
        var i = 1;
        $("#addanswersbutton").click(function (e) {
            e.preventDefault();
            console.log('dsafuq');

            var input = $('#addanswers').val();
            var $li = $('<li class="col-sm-10 col-md-10 container"></li>');
            $button=$('<button class="btn col-sm-2 col-md-2 pull-right removebutton" id="removebutton' + i + '">delete</button>');
            $p= $('<h1>' + i + '.  ' + input + '</h1>');
                    $li.append($button);
        $li.append($p);
            
         //   array.push($li);
array = array.add($button);
            $("#show-answers").append(array);
            i++;

        });
         console.log('nok');
        $(".removebutton").click(function (e) {

            console.log('ok');

        });
    });
</script>

@endsection
