@extends('layouts.app')

@section('page_title')
<h2 id="page_title">SMS</h2>
@endsection

@section('content')

<div class="open-form">                    
    <div class="cl-form">
        <h1>Message Specific Class:</h1>
    <form action="{{ route('sms.send_specific') }}" method="POST">
        @csrf
        <label for="class">Class:</label>
        <select name="class" id="class">
                @for ($i = 1; $i <= 8; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor 
        </select><br>
        <input type="text" name="title" placeholder="Title"><br>
        <textarea name="message" id="messsage" cols="30" rows="10" placeholder="Write message here..."></textarea><br>
        <input type="submit" value="Send Message">
    </form>    
    </div>
</div>

@endsection