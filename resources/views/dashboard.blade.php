@extends('layouts.app')

@section('page_title')
    <h2 id="page_title">Dashboard</h2>
@endsection
@section('content')

<section class="sec-cards">

  <div class="dash-cards">
    <a href="/register" class="dash-card border-blue">
      <div class="card-text">Admin Registration</div>
    </a>
    <a href="/classes" class="dash-card border-green">
      <div class="card-text">Classes</div>
    </a>
    <a href="/select_class" class="dash-card border-orange">
      <div class="card-text">Exams</div>
    </a>
    <a href="/sms" class="dash-card border-red">
      <div class="card-text">SMS</div>
    </a>
  </div>

</section>

<section class="quick-info">

  <div class="quick-info-card">
    <div class="header">
      <h4>USERS</h4>
      <small>ADMINISTRATION</small>
    </div>
  <div class="body">
    @if (count($admin_users) > 0)
      @foreach ($admin_users as $user)
      <div class="stats">
        <div class="number"><h2>{{$loop->index + 1}}</h2></div>
        <svg class="half-circle" viewBox="0 0 106 57">
          <path d="M102 4c0 27.1-21.9 49-49 49S4 31.1 4 4"></path>
        </svg>
      <a href="{{route('users.edit', ['user' => $user->id])}}"><div class="num-content">{{$user->name}}</div></a>
      </div>
    @endforeach
    @endif
  </div>
  </div>

  <div class="quick-info-card">
    <div class="header">
      <h4>RECENT EXAMS</h4>
      <small>CANDIDATES</small>
    </div>
    <div class="body">
    @if (count($exams) > 0)
        @foreach ($exams as $exam)
          <div class="stats">
            <div class="number"><h2>{{$loop->index + 1}}</h2></div>
            <svg class="half-circle" viewBox="0 0 106 57">
              <path d="M102 4c0 27.1-21.9 49-49 49S4 31.1 4 4"></path>
            </svg>
          <div class="num-content"><a href="/results/{{$exam->exam_id}}">{{$exam->exam_name}}</a></div>
          </div>
        @endforeach
    @endif
  </div>  
  </div>

<div class="quick-info-card">
  <div class="header">
    <h4>TOP PERFOMERS</h4>
    <small>CANDIDATES</small>
  </div>
<div class="body">
  @if (count($top_perfomers) > 0)
    @foreach ($top_perfomers as $perfomer)
    <div class="stats">
      <div class="number"><h2>{{$loop->index + 1}}</h2></div>
    @foreach ($students as $student)
     @if ($perfomer->upi == $student->upi)
      <svg class="half-circle" viewBox="0 0 106 57">
        <path d="M102 4c0 27.1-21.9 49-49 49S4 31.1 4 4"></path>
      </svg>
    <div class="num-content">
      {{$student->fname}} {{$student->sname}}
      @if ($perfomer->stream == 'East')
          (E)
      @else
          (W)
      @endif
    </div>
    </div>
     @endif
  @endforeach
  @endforeach
  @endif
</div>
</div>

<div class="quick-info-card">
  <div class="header">
    <h4>ClASSES</h4>
    <small>ALL</small>
  </div>
<div class="body">
  @if (count($classes) > 0)
    @foreach ($classes as $class)
    <div class="stats">
      <div class="number"><h2>{{$loop->index + 1}}</h2></div>
      <svg class="half-circle" viewBox="0 0 106 57">
        <path d="M102 4c0 27.1-21.9 49-49 49S4 31.1 4 4"></path>
      </svg>
      <a href="/classes/{{$class->class_id}}" class="cl-button">
      <div class="num-content">{{$class->class}} {{$class->stream}}</div></a>
    </div>
  @endforeach
  @endif
</div>
</div>


</section>
  
  

@endsection
