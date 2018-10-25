@extends('layouts.app')

@section('content')


<div class="quiz-box card">
    <div class="card-header">
        <h1>Name: <strong> {{$quiz->name}}</strong></h1>
        <h1>{{$quiz->title}}</h1>
        <p>Debug info quizID: <strong>{{$quiz->id}}</strong></p> 
    </div>

    <ul class="card-body" Style="list-style: none;">
        <div class="row">       
            <div class=" col">          
                <a href="{{$quiz->QuestionPaginate()->previousPageUrl()}}" class="btn btn-success "> <strong>< </strong>Previous Question </a>
            </div>
            <div class=" col text-right"> 
                <a href="{{$quiz->QuestionPaginate()->nextPageUrl()}}" class="btn btn-success">Next Question <strong>></strong></a>
            </div>
        </div>
        @foreach($quiz->QuestionPaginate() as $question)
        <div class="question-box">

            <li><h3><span class="badge badge-success" id="">{{$quiz->QuestionPaginate()->currentPage() }}.</span><strong>&nbsp {{$question->body}}</strong></h3>

            </li>
            <br>

            <ul class="list-group row" >
                @foreach($question->Answers() as $answer)

                @if($question->UserAnswers($answer->id))
                <li class="list-group-item list-group-item-success" data-qid="{{$question->id}}" id="answer{{$answer->id}}">{{$answer->body}}</li>

                @else   
                <li class="list-group-item" data-qid="{{$question->id}}" id="answer{{$answer->id}}">{{$answer->body}}</li>

                @endif  
                @endforeach

                <br>

            </ul>

        </div>

        @endforeach
        <div class="container col-sm-4">
            {{ $quiz->QuestionPaginate()->links() }}


        </div>
    </ul>

    <div class=" col-sm-4">        
        <p><a href="/{{$quiz->name}}/CreateQuestion">Add question</a></p>
    </div>
    <div class=" col-sm-4">
        <p><a href="/{{$quiz->name}}/1">Check results</a></p>
    </div>

    <br>
</div>


<script>
    function makenewquestion() {

     window.location='/'+{{$quiz->name}}+'/CreateQuestion';
    }

    $(document).ready(function () {

        $('.list-group-item').click(function () {
            var element = document.getElementById($(this).attr('id'));
            var ansid = Number($(this).attr('id').slice(6));
            var qid = $(this).attr('data-qid');
            // console.log(qid);   

            addanswer(ansid, qid);

        });

    });

    function addanswer(temp, temp2) {

        // document.getElementById('up_vote_comment' + temp).innerHTML = vote + 1;

        var useranswerid = temp;
        var questionid = temp2;
        console.log(window.location.host);
        
        console.log(window.location.href);
        var _token = $("input[name='_token']").val();
        $.ajax({
            method: "POST",
            url: '/addajaxanswer',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: { _token:_token , useranswerid: useranswerid, questionid: questionid}
        })
                .done(function (data) {
                    //    console.log('merge');
                    var element = document.getElementById('answer' + useranswerid);
                    element.classList.remove('list-group-item-success');
                    console.log(data['useranswer']);

                    if (data['useranswer'] != 0) {
                        element.classList.add('list-group-item-success');
                        console.log('merge');
                    }
                }).fail(function($xhr){
                      var data = $xhr.responseJSON;
                    console.log(data);
                    });
            }
</script>

@endsection
