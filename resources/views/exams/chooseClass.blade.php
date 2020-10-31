@extends('layouts.app')

@section('page_title')
<h2 id="page_title">SELECT CLASS</h2>
@endsection

@section('content')


<section class="sec-cards">

  <div class="dash-cards">
   <a href="{{route('exams.index', ['id' => 8])}}" class="dash-card border-blue">
      <div class="card-text">Class 8</div>
    </a>
    <a href="{{route('exams.index', ['id' => 7])}}" class="dash-card border-green">
      <div class="card-text">Class 7</div>
    </a>
    <a href="{{route('exams.index', ['id' => 6])}}" class="dash-card border-orange">
      <div class="card-text">Class 6</div>
    </a>
    <a href="{{route('exams.index', ['id' => 5])}}" class="dash-card border-red">
      <div class="card-text">Class 5</div>
    </a>
    <a href="{{route('exams.index', ['id' => 4])}}" class="dash-card border-blue">
      <div class="card-text">Class 4</div>
    </a>
    <a href="{{route('exams.index', ['id' => 3])}}" class="dash-card border-green">
      <div class="card-text">Class 3</div>
    </a>
    <a href="{{route('exams.index', ['id' => 2])}}" class="dash-card border-orange">
      <div class="card-text">Class 2</div>
    </a>
    <a href="{{route('exams.index', ['id' => 1])}}" class="dash-card border-red">
      <div class="card-text">Class 1</div>
    </a>
  </div>

</section>

@endsection