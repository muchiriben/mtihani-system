@extends('layouts.app')

@section('page_title')
<h2 id="page_title">Class {{$class}} Exams</h2>
@endsection

@section('content')

<section class="new-class">
    <details>
      <summary>Create new exam</summary>
      <div class="cl-form">
      <form action="{{ route('exams.store') }}" method="POST">
       @csrf
             <label for="class">Exam name:</label>
             <input type="text" name="exam_name" required><br>
             <label for="exam_class">For Class: {{$class}}</label>
             <input type="hidden" name="exam_class" value={{$class}}>
             <input type="submit" value="Create">
         </form>
      </div>
    </details>
</section>

<section class="sec-cards">

  <div class="dash-cards">

    @if (count($exams) > 0)
        @foreach ($exams as $exam)
  <a href="{{route('results.index', ['id' => $exam->exam_id])}}" class="dash-card border-blue">
               <div class="card-text">{{$exam->exam_name}}</div>
            </a>
        @endforeach
    @endif
  </div>
  <div class="links">
    {{$exams->links()}}
  </div>

</section>

@endsection