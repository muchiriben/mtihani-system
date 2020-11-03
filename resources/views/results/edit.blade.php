@extends('layouts.app')

@section('page_title')
<h2 id="page_title">UPI NUMBER: {{$result->upi}}</h2>
@endsection

@section('content')

<div class="open-form">
    <h2>EDIT RESULTS DETAILS</h2>
    <div class="cl-form">
        <form action="{{ route('results.update', ['id' => $result->results_id]) }}" method="POST">
            @csrf
            <label for="grammar">Grammar:</label>
            <input type="number" value="{{$result->grammar}}" name="grammar" required>
            <label for="composition">Composition:</label>
            <input type="number" value="{{$result->composition}}" name="composition" required>
            <label for="lugha">Lugha:</label>
            <input type="number" value="{{$result->lugha}}" name="lugha" required>
            <label for="insha">Insha:</label>
            <input type="number" value="{{$result->insha}}" name="insha" required>
            <label for="mathematics">Mathematics:</label>
            <input type="number" value="{{$result->mathematics}}" name="mathematics" required>
            <label for="science">Science:</label>
            <input type="number" value="{{$result->science}}" name="science" required>
            <label for="social_studies">Social Studies:</label>
            <input type="number" value="{{$result->social_studies}}" name="social_studies" required>
            <label for="religious_education">Religious Education:</label>
            <input type="number" value="{{$result->religious_education}}" name="religious_education" required><br>
         <input type="submit" name="edit" value="Edit">
           </form>
        </div>
</div>
@endsection