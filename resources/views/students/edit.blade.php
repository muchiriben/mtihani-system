@extends('layouts.app')

@section('page_title')
<h2 id="page_title">{{$student->fname}} {{$student->sname}}</h2>
@endsection

@section('content')

<div class="open-form">
    <h2>EDIT STUDENT DETAILS</h2>
    <div class="cl-form">
        <form action="{{ route('students.update', ['student' => $student->student_id]) }}" method="POST">
            @csrf
            {{method_field('PUT')}}
         <label for="upi">Enter UPI No:</label>
        <input type="text" name="upi" value="{{$student->upi}}" required>
         <label for="fname">Student's First Name:</label>
         <input type="text" name="fname" value="{{$student->fname}}" required>
         <label for="sname">Student's second name:</label>
         <input type="text" name="sname" value="{{$student->sname}}" required>
         <label for="parent">Enter Parent's Names:</label>
         <input type="text" name="parent_names" value="{{$student->parent_names}}" required>
         <label for="contact">Enter Parent's contact:</label>
         <input type="number" name="parent_contact" value="{{$student->parent_contact}}" maxlength="10" minlength="10" required><br>
         <input type="submit" name="edit" value="Edit">
           </form>
        </div>
</div>
@endsection