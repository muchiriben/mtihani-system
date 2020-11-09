@extends('layouts.app')

@section('page_title')
<h2 id="page_title">Search Results</h2>
@endsection
@section('content')
      
<table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">UPI</th>
        <th scope="col">Composition</th>
        <th scope="col">Grammar</th>
        <th scope="col">English</th>
        <th scope="col">Insha</th>
        <th scope="col">Lugha</th>
        <th scope="col">Kiswahili</th>
        <th scope="col">Mathematics</th>
        <th scope="col">Science</th>
        <th scope="col">Social Studies</th>
        <th scope="col">Religious Ed.</th>
        <th scope="col">SS & Re</th>
        <th scope="col">Total</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
        @if (count($results) > 0)
        @foreach ($results as $result)
        <tr>
        <th scope="row">{{$loop->index + 1}}</th>
            <td>{{$result->upi}}</td>
            <td>{{$result->composition}}</td>
            <td>{{$result->grammar}}</td>
            <td>{{$result->english}}</td>
            <td>{{$result->insha}}</td>
            <td>{{$result->lugha}}</td>
            <td>{{$result->kiswahili}}</td>
            <td>{{$result->mathematics}}</td>
            <td>{{$result->science}}</td>
            <td>{{$result->social_studies}}</td>
            <td>{{$result->religious_education}}</td>
            <td>{{$result->ss_re}}</td>
            <td>{{$result->total}}</td>
            <td>
              
              <button class="actions"><a href="{{ route('results.edit', ['id' => $result->results_id]) }}">EDIT</a></button>
              <form action="{{ route('results.destroy', ['id' => $result->results_id]) }}" method="POST">
                @csrf
                {{method_field('DELETE')}}
                <input class="actions" type="submit" name="delete" value="DELETE">
              </form>

          </td>
          
          @endforeach   
        @endif  
    </tbody>
  </table>

@endsection