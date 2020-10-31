@extends('layouts.app')

@section('page_title')
    <h2 id="page_title">Classes</h2>
@endsection
@section('content')

<section class="new-class">
     <details>
       <summary>Create new class</summary>
       <div class="cl-form">
       <form action="{{ route('classes.store') }}" method="POST">
        @csrf
              <label for="class">Class:</label>
              <select name="class" id="class">
                @for ($i = 1; $i <= 8; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor 
              </select>
              <label for="class-stream">Class Stream:</label>
              <select name="class-stream" id="class-stream">
                    <option value="East">East</option>
                    <option value="West">West</option>
              </select>
              <label for="year-of">Year of:</label>
              <input type="text" id="year-of" name="year-of">
              <label for="class-teacher">Class Teacher:</label>
              <input type="text" id="class-teacher" name="class-teacher"><br>
              <input type="submit" value="Create">
          </form>
       </div>
     </details>
</section>

<section class="cont">
  @if (count($classes) > 0)
    @foreach ($classes as $class)
    <div class="cl-cards">
    <div class="c-header">{{$class->class}} {{$class->stream}}</div>
      <div class="c-body">
      <h5>Teacher: {{$class->class_teacher}}</h5>
        <h5>No. of Students: 54</h5>
      <h5>Year of: {{$class->year_of}}</h5>
      <a href="/classes/{{$class->class_id}}" class="cl-button">View</a>
      </div>
    </div>
    @endforeach
  @endif  

</section>

@endsection
