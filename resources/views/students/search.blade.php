@extends('layouts.app')

@section('page_title')
<h2 id="page_title">Search Results</h2>
@endsection
@section('content')

@if (count($students) > 0)
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
        @foreach ($students as $student)
        <tr>
        <th scope="row">{{$loop->index + 1}}</th>
            <td>{{$student->upi}}</td>
            <td>{{$student->fname}}</td>
            <td>{{$student->sname}}</td>
            <td>{{$student->parent_names}}</td>
            <td>{{$student->parent_contact}}</td>
            <td>

           <button class="actions"><a href="{{ route('students.edit', ['student' => $student->student_id]) }}">EDIT</a></button>   
          <form action="{{ route('students.destroy', ['student' => $student->student_id]) }}" method="POST">
            @csrf
            {{method_field('DELETE')}}
            <input class="actions" type="submit" name="delete" value="DELETE">
          </form>

          </td>

          </tr>
          
        @endforeach
      @else
      <p>No results</p>
      @endif
      
    </tbody>
  </table>

@endsection
