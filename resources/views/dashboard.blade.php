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
      <h4>RECENT EXAMS</h4>
    </div>
    @if (count($exams) > 0)
        @foreach ($exams as $exam)
        <div class="body">
          <div class="stats">
            <div class="number"><h2>{{$loop->index + 1}}</h2></div>
            <svg class="half-circle" viewBox="0 0 106 57">
              <path d="M102 4c0 27.1-21.9 49-49 49S4 31.1 4 4"></path>
            </svg>
          <div class="num-content"><a href="/results/{{$exam->exam_id}}">{{$exam->exam_name}}</a></div>
          </div>
        </div>
        @endforeach
    @endif
  </div>

<div class="quick-info-card">
  <div class="header">
    <h4>TOP PERFOMERS</h4>
  </div>
  <div class="body">
<div class="stats">
  <div class="number"><h2>1</h2></div>
  <svg class="half-circle" viewBox="0 0 106 57">
    <path d="M102 4c0 27.1-21.9 49-49 49S4 31.1 4 4"></path>
  </svg>
  <div class="num-content">Benard Muchiri</div>
</div>
<div class="stats">
  <div class="number"><h2>2</h2></div>
  <svg class="half-circle" viewBox="0 0 106 57">
    <path d="M102 4c0 27.1-21.9 49-49 49S4 31.1 4 4"></path>
  </svg>
  <div class="num-content">Samuel Simam</div>
</div>
<div class="stats">
  <div class="number"><h2>3</h2></div>
  <svg class="half-circle" viewBox="0 0 106 57">
    <path d="M102 4c0 27.1-21.9 49-49 49S4 31.1 4 4"></path>
  </svg>
  <div class="num-content">Hellen Njoroge</div>
</div>
<div class="stats">
  <div class="number"><h2>4</h2></div>
  <svg class="half-circle" viewBox="0 0 106 57">
    <path d="M102 4c0 27.1-21.9 49-49 49S4 31.1 4 4"></path>
  </svg>
  <div class="num-content">Hellen Simam</div>
</div>
  </div>
</div>

<div class="quick-info-card">
  <div class="header">
    <h4>MOST IMPROVED</h4>
  </div>
  <div class="body">
    <div class="stats">
      <div class="number"><h2>1</h2></div>
      <svg class="half-circle" viewBox="0 0 106 57">
        <path d="M102 4c0 27.1-21.9 49-49 49S4 31.1 4 4"></path>
      </svg>
      <div class="num-content">Martins Lovel</div>
    </div>
    <div class="stats">
      <div class="number"><h2>2</h2></div>
      <svg class="half-circle" viewBox="0 0 106 57">
        <path d="M102 4c0 27.1-21.9 49-49 49S4 31.1 4 4"></path>
      </svg>
      <div class="num-content">Bukar Mariele</div>
    </div>
    <div class="stats">
      <div class="number"><h2>3</h2></div>
      <svg class="half-circle" viewBox="0 0 106 57">
        <path d="M102 4c0 27.1-21.9 49-49 49S4 31.1 4 4"></path>
      </svg>
      <div class="num-content">Ceolmund Seyfettin</div>
    </div>
    <div class="stats">
      <div class="number"><h2>4</h2></div>
      <svg class="half-circle" viewBox="0 0 106 57">
        <path d="M102 4c0 27.1-21.9 49-49 49S4 31.1 4 4"></path>
      </svg>
      <div class="num-content">Austin Aslan</div>
    </div>
      </div>
</div>


<div class="quick-info-card">
  <div class="header">
    <h4>TOP SUBJECTS</h4>
  </div>
  <div class="body">
    <div class="stats">
      <div class="number"><h2>1</h2></div>
      <svg class="half-circle" viewBox="0 0 106 57">
        <path d="M102 4c0 27.1-21.9 49-49 49S4 31.1 4 4"></path>
      </svg>
      <div class="num-content">Mathematics</div>
    </div>
    <div class="stats">
      <div class="number"><h2>2</h2></div>
      <svg class="half-circle" viewBox="0 0 106 57">
        <path d="M102 4c0 27.1-21.9 49-49 49S4 31.1 4 4"></path>
      </svg>
      <div class="num-content">Science</div>
    </div>
    <div class="stats">
      <div class="number"><h2>3</h2></div>
      <svg class="half-circle" viewBox="0 0 106 57">
        <path d="M102 4c0 27.1-21.9 49-49 49S4 31.1 4 4"></path>
      </svg>
      <div class="num-content">English</div>
    </div>
    <div class="stats">
      <div class="number"><h2>4</h2></div>
      <svg class="half-circle" viewBox="0 0 106 57">
        <path d="M102 4c0 27.1-21.9 49-49 49S4 31.1 4 4"></path>
      </svg>
      <div class="num-content">Kiwsahili</div>
    </div>
      </div>
</div>
</section>
  
  

@endsection
