@extends('layouts.app')

@section('page_title')
<h2 id="page_title">{{$class->class}} {{$class->stream}}</h2>
@endsection
@section('content')

<section class="new-class">
    <details class="edit-class">
      <summary>Edit class details</summary>
      <div class="cl-form">
      <form action="{{ route('classes.update', ['class' => $class->class_id]) }}" method="POST">
        @csrf
        {{method_field('PUT')}}
             <label for="class">Class:</label>
             <select name="class" id="class">
                <option value="{{ $class->class }}">{{ $class->class }}</option>
               @for ($i = 1; $i <= 8; $i++)
                   <option value="{{ $i }}">{{ $i }}</option>
               @endfor 
             </select>
             <label for="class-stream">Class Stream:</label>
             <select name="class-stream" id="class-stream">
             <option value="{{$class->stream}}">{{$class->stream}}</option>
                   <option value="East">East</option>
                   <option value="West">West</option>
             </select>
             <label for="year-of">Year of:</label>
            <input type="text" id="year-of" name="year-of" value="{{$class->year_of}}">
             <label for="class-teacher">Class Teacher:</label>
            <input type="text" id="class-teacher" name="class-teacher" value="{{$class->class_teacher}}"><br>
            <input type="hidden">
             <input type="submit" value="Edit">
         </form>
      </div>
    </details>

    <details class="reg-student">
        <summary>Register new student</summary>
        <div class="cl-form">
        <form action="{{ route('students.store') }}" method="POST">
         @csrf
         <input type="hidden" name="class_id" value="{{$class->class_id}}">
         <label for="upi">Enter UPI No:</label>
         <input type="text" name="upi" required>
         <label for="fname">Student's First Name:</label>
         <input type="text" name="fname" required>
         <label for="sname">Student's second name:</label>
         <input type="text" name="sname" required>
         <label for="parent">Enter Parent's Names:</label>
         <input type="text" name="parent_names" required>
         <label for="contact">Enter Parent's contact:</label>
         <input type="number" name="parent_contact" maxlength="10" minlength="10" required><br>
         <input type="submit" name="reg" value="Register">
           </form>
        </div>
      </details>
</section>

<section class="view-students">  
  <div class="top-section">
    <h4>STUDENTS</h4>
    <form action="">
        <input type="search" name="search" placeholder="Search UPI e.g ABCDE">
        <input type="submit" name="search" value="Search">
    </form>
  </div>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">UPI</th>
        <th scope="col">First Name</th>
        <th scope="col">Last Name</th>
        <th scope="col">Parent Names</th>
        <th scope="col">Parent Contact</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
        @if (count($students) > 0)
        @foreach ($students as $student)
        <tr>
        <th scope="row">{{$loop->index + 1}}</th>
            <td>{{$student->upi}}</td>
            <td>{{$student->fname}}</td>
            <td>{{$student->sname}}</td>
            <td>{{$student->parent_names}}</td>
            <td>{{$student->parent_contact}}</td>
            <td>
              
          <a href="{{ route('students.edit', ['student' => $student->student_id]) }}">EDIT</a><br>
          <form action="{{ route('students.destroy', ['student' => $student->student_id]) }}" method="POST">
            @csrf
            {{method_field('DELETE')}}
            <input type="submit" name="delete" value="DELETE">
          </form>

          </td>

          </tr>
          
        @endforeach
      @endif  
    </tbody>
  </table>
  <div class="links">
    {{$students->links()}}
    <a class="downloadBtn" href="{{ route('students.export', ['id' => $class->class_id]) }}"><i class="fa fa-download fa-lg" style="color: #ffffff; margin-right:5px"></i>Download</a>
  </div>
</section>
    
@endsection