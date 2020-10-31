
@if (count($errors)> 0)

    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">
            <h5>{{$error}}</h5>
        </div>   
    @endforeach
    
@endif


@if (session('success'))

    <div class="alert alert-success">
        <h5>{{session('success')}}</h5>
    </div>
    
@endif


@if (session('error'))
    <div class="alert alert-danger">
        <h5>{{session('error')}}</h5>
    </div>    
@endif