@extends('layouts.app')

@section('page_title')
<h2 id="page_title">{{$user->name}}</h2>
@endsection

@section('content')

<div class="open-form">                    
<h1> Edit Admin User</h1>
<div class="cl-form">
<form action="{{ route('users.update', $user) }}" method="POST">
    @csrf
    {{method_field('PUT')}}
    <div class="form-group row">
        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

        <div class="col-md-6">
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    
    <div class="form-group row">
        <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

        <div class="col-md-6">
            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $user->username }}" required autocomplete="username">

            @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    
    <input type="submit" class="btn btn-primary" value="Edit"><br>
</form>
<form action="{{route('users.destroy', $user)}}" method="POST">
    @csrf
    {{method_field('DELETE')}}
    <button class="btn btn-danger" style="width:200px;">Delete</button>
   </form><br>
<a href="/register" class="btn btn-primary">Register new user</a><br><br>   
<a href="/dashboard" class="btn btn-success" style="width:100px;">Back</a>
</div>
</div>
           
@endsection
