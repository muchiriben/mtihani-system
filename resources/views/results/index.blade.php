@extends('layouts.app')

@section('page_title')
<h2 id="page_title">{{$exam->exam_name}}</h2>
@endsection

@section('content')

<section class="stream-selector">
  <button id="east">{{$exam->exam_class}} East</button>
  <button id="west">{{$exam->exam_class}} West</button>
</section>

<section class="stream east">
  <div class="stream-title">
  <h1 class="title">{{$exam->exam_class}} East</h1>
  </div>
<section class="new-class">
    <details>
      <summary>Edit exam details</summary>
      <div class="cl-form">
      <form action="{{ route('exams.update', ['id' => $exam->exam_id]) }}" method="POST">
       @csrf
             <label for="class">Exam name:</label>
             <input type="text" name="exam_name" value="{{$exam->exam_name}}"><br>
             <input type="submit" value="Edit">
         </form>
      </div>
    </details>

    <details>
        <summary>Add record</summary>
        <div class="cl-form">
        <form action="{{ route('results.store') }}" method="POST">
         @csrf
        <input type="hidden" name="exam_id" value="{{$exam->exam_id}}">
        <input type="hidden" name="stream" value="East">
         <label for="upi">UPI:</label>
         <select name="upi" id="upi">

          @foreach ($classes as $class)
            @if ($class->class == $exam->exam_class && $class->stream == 'East')
              @foreach ($students as $student)
                @if ($student->classroom_class_id == $class->class_id)
                  <option value="{{$student->upi}}">{{$student->upi}} {{$student->fname}} {{$student->sname}}</option>
                @endif
              @endforeach
            @endif
          @endforeach

         </select>
         <label for="composition">Composition:</label>
         <input type="number" placeholder="Composition" name="composition" required>
         <label for="grammah">Grammah:</label>
         <input type="number" placeholder="Grammar" name="grammar" required>
         <label for="insha">Insha:</label>
         <input type="number" placeholder="Insha" name="insha" required>
         <label for="lugha">Lugha:</label>
         <input type="number" placeholder="Lugha" name="lugha" required>
         <label for="mathematics">Mathematics:</label>
         <input type="number" placeholder="Mathematics" name="mathematics" required>
         <label for="science">Science:</label>
         <input type="number" placeholder="Science" name="science" required>
         <label for="social_studies">Social Studies:</label>
         <input type="number" placeholder="Socials Studies" name="social_studies" required>
         <label for="religious_education">Religious Education:</label>
         <input type="number" placeholder="Religious Education" name="religious_education" required><br>
         <input type="submit" name="reg" value="Add">
           </form>
        </div>
      </details>

      <div class="results">
        <div class="top-section">
          <h4>Showing {{ $results_east->firstItem() }} - {{ $results_east->lastItem() }}</h4>
          <form action="{{ url('/search_results') }}" type="get">
            <input type="search" name="search" placeholder="Search UPI e.g ABCDE">
            <input type="hidden" name="exam" value="{{$exam->exam_id}}">
            <input type="submit" value="Search">
        </form>
        </div>
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
              @if (count($results_east) > 0)
              @foreach ($results_east as $result)
              <tr>
              <th scope="row">{{$loop->index + $results_east->firstItem()}}</th>
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
                
                </tr>
              
              @if ($results_east->lastPage() == $results_east->currentPage())
              <tr>
                <th>Total</th>
                <th> --- </th>
                <th> {{$totals_east['comp']}} </th>
                <th> {{$totals_east['grammar']}} </th>
                <th> {{$totals_east['english']}}</th>
                <th> {{$totals_east['insha']}} </th>
                <th> {{$totals_east['lugha']}} </th>
                <th> {{$totals_east['kiswahili']}} </th>
                <th> {{$totals_east['mathematics']}} </th>
                <th> {{$totals_east['science']}} </th>
                <th> {{$totals_east['ss']}} </th>
                <th> {{$totals_east['re']}} </th>
                <th> {{$totals_east['ssre']}} </th>
                <th> {{$totals_east['total']}} </th>
                <th> --- </th>
              </tr>
              <tr>
                <th>Mean</th>
                <th> --- </th>
                <th> {{$means_east['comp']}} </th>
                <th> {{$means_east['grammar']}} </th>
                <th> {{$means_east['english']}}</th>
                <th> {{$means_east['insha']}} </th>
                <th> {{$means_east['lugha']}} </th>
                <th> {{$means_east['kiswahili']}} </th>
                <th> {{$means_east['mathematics']}} </th>
                <th> {{$means_east['science']}} </th>
                <th> {{$means_east['ss']}} </th>
                <th> {{$means_east['re']}} </th>
                <th> {{$means_east['ssre']}} </th>
                <th> {{$means_east['total']}} </th>
                <th> --- </th>
              </tr>
              @endif 
              @endforeach
              
            @endif  
          </tbody>
        </table>
        <div class="links">
          {{$results_east->links()}}
          <a class="downloadBtn" href="{{ route('results.export', ['id' => $exam->exam_id, 'stream' => 'East']) }}"><i class="fa fa-download fa-lg" style="color: #ffffff; margin-right:5px"></i>Download</a>
        </div>
      </div>
</section>

</section>


<section class="stream west">
  <div class="stream-title">
    <h1>{{$exam->exam_class}} West</h1>
  </div>
  <section class="new-class">
      <details>
        <summary>Edit exam</summary>
        <div class="cl-form">
        <form action="{{ route('exams.update', ['id' => $exam->exam_id]) }}" method="POST">
         @csrf
               <label for="class">Exam name:</label>
               <input type="text" name="exam_name" value="{{$exam->exam_name}}"><br>
               <input type="submit" value="Edit">
           </form>
        </div>
      </details>
  
      <details>
          <summary>Add record</summary>
          <div class="cl-form">
          <form action="{{ route('results.store') }}" method="POST">
           @csrf
          <input type="hidden" name="exam_id" value="{{$exam->exam_id}}">
          <input type="hidden" name="stream" value="West">
           <label for="upi">UPI:</label>
           <select name="upi" id="upi">
            
            @foreach ($classes as $class)
            @if ($class->class == $exam->exam_class && $class->stream == 'West')
              @foreach ($students as $student)
                @if ($student->classroom_class_id == $class->class_id)
                  <option value="{{$student->upi}}">{{$student->upi}} {{$student->fname}} {{$student->sname}}</option>
                @endif
              @endforeach
            @endif
          @endforeach

       </select>
           <label for="composition">Composition:</label>
           <input type="number" placeholder="Composition" name="composition" required>
           <label for="grammar">Grammar:</label>
           <input type="number" placeholder="Grammar" name="grammar" required>
           <label for="insha">Insha:</label>
           <input type="number" placeholder="Insha" name="insha" required>
           <label for="lugha">Lugha:</label>
           <input type="number" placeholder="Lugha" name="lugha" required>
           <label for="mathematics">Mathematics:</label>
           <input type="number" placeholder="Mathematics" name="mathematics" required>
           <label for="science">Science:</label>
           <input type="number" placeholder="Science" name="science" required>
           <label for="social_studies">Social Studies:</label>
           <input type="number" placeholder="Socials Studies" name="social_studies" required>
           <label for="religious_education">Religious Education:</label>
           <input type="number" placeholder="Religious Education" name="religious_education" required><br>
           <input type="submit" name="reg" value="Add">
             </form>
          </div>
        </details>
  
        <div class="results">
          <div class="top-section">
          <h4>Showing {{ $results_west->firstItem() }} - {{ $results_west->lastItem() }}</h4>
          <form action="{{ url('/search_results') }}" type="get">
            <input type="search" name="search" placeholder="Search UPI e.g ABCDE">
            <input type="hidden" name="exam" value="{{$exam->exam_id}}">
            <input type="submit" value="Search">
        </form>
          </div>
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
                @if (count($results_west) > 0)
                @foreach ($results_west as $result)
                <tr>
                <th scope="row">{{$loop->index + $results_west->firstItem()}}</th>
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
                  
                  </tr>
              
                @if ($results_west->lastPage() == $results_west->currentPage())
                <tr>
                  <th>Total</th>
                  <th> --- </th>
                  <th> {{$totals_west['comp']}} </th>
                  <th> {{$totals_west['grammar']}} </th>
                  <th> {{$totals_west['english']}}</th>
                  <th> {{$totals_west['insha']}} </th>
                  <th> {{$totals_west['lugha']}} </th>
                  <th> {{$totals_west['kiswahili']}} </th>
                  <th> {{$totals_west['mathematics']}} </th>
                  <th> {{$totals_west['science']}} </th>
                  <th> {{$totals_west['ss']}} </th>
                  <th> {{$totals_west['re']}} </th>
                  <th> {{$totals_west['ssre']}} </th>
                  <th> {{$totals_west['total']}} </th>
                  <th> --- </th>
                </tr>
                <tr>
                  <th>Mean</th>
                  <th> --- </th>
                  <th> {{$means_west['comp']}} </th>
                  <th> {{$means_west['grammar']}} </th>
                  <th> {{$means_west['english']}}</th>
                  <th> {{$means_west['insha']}} </th>
                  <th> {{$means_west['lugha']}} </th>
                  <th> {{$means_west['kiswahili']}} </th>
                  <th> {{$means_west['mathematics']}} </th>
                  <th> {{$means_west['science']}} </th>
                  <th> {{$means_west['ss']}} </th>
                  <th> {{$means_west['re']}} </th>
                  <th> {{$means_west['ssre']}} </th>
                  <th> {{$means_west['total']}} </th>
                  <th> --- </th>
                </tr>
                @endif
                @endforeach
                
              @endif  
            </tbody>
          </table>
          <div class="links">
            {{$results_west->links()}}
            <a class="downloadBtn" href="{{ route('results.export', ['id' => $exam->exam_id, 'stream' => 'West']) }}"><i class="fa fa-download fa-lg" style="color: #ffffff; margin-right:5px"></i>Download</a>
          </div>
        </div>
  </section>
  
  </section>



@endsection