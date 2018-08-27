@extends('layouts.app')

@section('content')





<h2>Add new question</h2>

{{Form::open(['route'=>'question.store','method'=>'POST'])}}


{{Form::text('type','Type',['class'=>'form-control'])}}



{{Form::hidden('id',$quiztempid)}}



{{Form::textarea('body','Body',['class'=>'form-control textarea','rows'=>'4'])}}


<div id="containerchange">
    <div id="div1">..</div>
    <div id="div2" class="hidden">..</div>
    <div id="div3" class="hidden">..</div>
</div>

{{Form::select('mode',['1' => 'Text answers', '0' => 'Multiple choice answer'])}}
{{Form::textarea('answer','Add keyward',['class'=>'form-control textarea','rows'=>'4'])}}

{{Form::submit('Add question',['class'=>'btn btn-primary'])}}


{{ Form::close() }}

<script>
    

    // Notice how I declare an onclick event in the javascript code
document.getElementById( 'containerchange' ).onclick = function( e ) {

    // First, get the clicked element
    // We have to add these lines because IE is bad.
    // If you don't work with legacy browsers, the following is enough:
    //     var target = e.target;
    var evt = e || window.event,
        target = evt.target || evt.srcElement;

    // Then, check if the target is what we want clicked
    // For example, we don't want to bother about inner tags
    // of the "div1, div2" etc.
    if ( target.id.substr( 0, 3 ) === 'div' ) {

        // Hide the clicked element
        target.className = 'hidden';

        // Now you have two ways to do what you want:
        //     - Either you don't care about browser compatibility and you use
        //       nextElementSibling to show the next element
        //     - Or you care, so to work around this, you can "guess" the next
        //       element's id, since it remains consistent
        // Here are the two ways:

        // First way
        target.nextElementSibling.className = '';

        // Second way
        // Strip off the number of the id (starting at index 3)
        var nextElementId = 'div' + target.id.substr( 3 );
        document.getElementById( nextElementId ).className = '';
    }
};
</script>
@endsection
