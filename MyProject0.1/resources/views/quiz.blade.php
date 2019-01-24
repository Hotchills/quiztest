@extends('layouts.app')

@section('content')

<h2 id="popmes" Style="border-radius: 25px;width:60%;;padding:5%;  margin:18%; ;background: white;z-index: 12;position:absolute;display:none;">Please click back on this page in 30 sec or the test will close.</h2>

<div class="quiz-box card">
    <div class="card-header">
        @auth
        <h1>Name: <strong> {{$quiz->name}}</strong></h1>

        <p>Debug info quizID: <strong>{{$quiz->id}}</strong></p> 
        @endauth
        <div class="row">       
            <div class=" col">   
                <h1>{{$quiz->title}}</h1>
            </div>
            <div class="col text-right">
                <h3 id="timelefttest">@if(0){{gmdate("H:i:s", $timeleft)}}@endif</h3>
            </div>
        </div>
    </div>
    <div id="blur" style="z-index: 10;display:none;position:absolute; width:100%; height:100%; background-color:black; opacity:0.3;"></div>

    <ul class="card-body" Style="list-style: none;">
        <div class="row">       
            <div class=" col">  

                @if($quiz->QuestionPaginate()->firstItem() !=1 )
                <a href="{{$quiz->QuestionPaginate()->previousPageUrl()}}" class="btn btn-success "> <strong>< </strong>Previous Question </a>
                @else
                <a href="{{$quiz->QuestionPaginate()->previousPageUrl()}}" class="btn btn-default disabled "> <strong>< </strong>Previous Question </a>
                @endif
            </div>
            <div class="col text-right"> 
                @if( $quiz->QuestionPaginate()->lastPage()!= $quiz->QuestionPaginate()->firstItem() ) 
                <a href="{{$quiz->QuestionPaginate()->nextPageUrl()}}" class="btn btn-success">Next Question <strong>></strong></a>
                @else
                <a href="{{$quiz->QuestionPaginate()->nextPageUrl()}}" class="btn btn-default disabled ">Next Question <strong>></strong></a>
                @endif
            </div>
        </div>
        @foreach($quiz->QuestionPaginate() as $question)
        <div class="question-box">
            <li><h3><span class="badge badge-success" >{{$quiz->QuestionPaginate()->currentPage() }}.</span><strong>&nbsp {{$question->body}} </strong></h3>
            </li>
            <br>
            <ul class="list-group row" >
                @foreach($question->Answers() as $answer)

                @if($question->UserAnswers($answer->id,$code))
                <li class="list-group-item list-group-item-success" data-qid="{{$question->id}}" id="answer{{$answer->id}}">{{$answer->body}}</li>

                @else   
                <li class="list-group-item" data-qid="{{$question->id}}" id="answer{{$answer->id}}">{{$answer->body}} </li>

                @endif  
                @endforeach

                <br>

            </ul>

        </div>

        <div class="  text-center">
            {{ $quiz->QuestionPaginate()->links() }}

        </div>
        <div class="col text-right">
            @if( $quiz->QuestionPaginate()->lastPage() == $quiz->QuestionPaginate()->firstItem() )
            {{ Form::open(['method' => 'POST', 'route' => ['finishtest.update',$code]]) }}
            {{ Form::hidden('closetest', 1) }}
            {{ Form::submit('Finish Test ',['class'=>'btn btn-danger '])}} 
            {{ Form::close() }}
            @endif
            @auth
            <br>
            {{ Form::open(['method' => 'DELETE', 'route' => ['delquestion.delete', $question->id]]) }}
            {{Form::submit('Delete question',['class'=>'btn btn-danger '])}} 
            {{ Form::close() }}
            @endauth

            @endforeach
        </div>
    </ul>


    @auth

    <div class=" col-sm-4">        
        <p><a href="/{{$quiz->name}}/CreateQuestion">Add question</a></p>
    </div>
    <div class=" col-sm-4">
        <p><a href='/grade/{{$code}}'>Check results</a></p>
    </div>

    @endauth
    <br>
</div>
<script>
    //functions to say on this page
var seconds = 30;
var el = document.getElementById('popmes');
var interval_id=0;

    function blurpage(){
        if(seconds > 0 ){
             seconds -= 1; 
                 el.innerText = "Please click back on this page in  " + seconds + " sec or the test will close.";
   
        }else{ clearInterval(interval_id);
        
         el.innerText = "Test has been closed because inactivity.";
         var closetest = 1;
         var _token = $("input[name='_token']").val();
           $.ajax({
            method: "POST",
            url: '/{{$code}}/FinishTest',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: { _token:_token, closetest }
        })
            .done(function (data) {
                    //  console.log(data['userid']);
                }).fail(function($xhr){

        var data = $xhr.responseJSON;
        //console.log(data);
        });
         
         
        }
      }
    $(window).focus(function() {
       // console.log("focus");
        console.log(interval_id);
        clearInterval(interval_id);
        interval_id=0;
        el.innerText = "Please click back on this page in 30 sec or the test will close.";
        if (!interval_id){  
          document.getElementById("blur").style.display  = "none";
        //  document.getElementById("div1").style.display  = "none";
          document.getElementById("popmes").style.display = "none";
            seconds=30;

            }
    });

$(window).blur(function() {
    interval_id = 0;   
    interval_id = setInterval(blurpage, 1000);
   // console.log("blur");
      console.log(interval_id);
      document.getElementById("blur").style.display  = "block";
   //  document.getElementById("div1").style.opacity = "0.7";
     document.getElementById("popmes").style.display = "block";
     
});
  //time test started  
    function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    var temp = setInterval(function () {
        minutes = parseInt(timer / 60, 10)
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds;

        if (++timer < 0) {
            timer = duration;
        }
    }, 1000);
}

window.onload = function () {
    var time ={{$timeleft}},
        display = document.querySelector('#timelefttest');
        startTimer(time, display);
};
     
    function makenewquestion() {
      window.location = '/' + {{$quiz->name}} + '/CreateQuestion';
    }

    $(document).ready(function (e) {
       
        $('.list-group-item').click(function () {
        var element = document.getElementById($(this).attr('id'));
        var answerid = Number($(this).attr('id').slice(6));
        var questionid = $(this).attr('data-qid');
        var code = window.location.pathname.slice(1, 16);
        //  console.log(code);  
        addanswer(answerid, questionid, code);
        });
    });
    
    function addanswer(temp, temp2, code) {
       
        var answerid = temp;
        var questionid = temp2;
        var quizcode = code;
       // console.log(answerid);
        //  console.log(window.location.href);
        var _token = $("input[name='_token']").val();
        $.ajax({
            method: "POST",
            url: '/addajaxanswer',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: { _token:_token, answerid: answerid, questionid: questionid, quizcode:quizcode}
        })
            .done(function (data) {
                    if(data['answer'] == 'fail'){
                        location.reload();
                    }
                    //    console.log('merge');
                    var element = document.getElementById('answer' + answerid);
                    element.classList.remove('list-group-item-success');
                    // console.log(data['grade']);
                    if (data['answer'] != 0) {
                        element.classList.add('list-group-item-success');
                    //   console.log('merge');
                    }
                    //  console.log(data['userid']);
                }).fail(function($xhr){

        var data = $xhr.responseJSON;
        //console.log(data);
        });
        }
     
</script>

@endsection
