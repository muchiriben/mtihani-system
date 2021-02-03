@extends('layouts.app')

@section('page_title')
<h2 id="page_title">SMS</h2>
@endsection

@section('content')

<div class="heading"><h1>Send Message To:</h1></div>

<section class="sec-cards">

    <div class="dash-cards">
      <a href="/message_all" class="dash-card border-blue">
        <div class="card-text">All Students/Parents</div>
      </a>
      <a href="/message_specific" class="dash-card border-green">
        <div class="card-text">Specific Class</div>
      </a>
      <a href="/message_bom" class="dash-card border-orange">
        <div class="card-text">B.O.M</div>
      </a>
      <a href="/message_teachers" class="dash-card border-red">
        <div class="card-text">Teachers</div>
      </a>
    </div>
  
  </section>
 
@endsection