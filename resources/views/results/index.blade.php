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
         <label for="grammah">Grammah:</label>
         <input type="number" placeholder="Grammar" name="grammar" required>
         <label for="composition">Composition:</label>
         <input type="number" placeholder="Composition" name="composition" required>
         <label for="lugha">Lugha:</label>
         <input type="number" placeholder="Lugha" name="lugha" required>
         <label for="insha">Insha:</label>
         <input type="number" placeholder="Insha" name="insha" required>
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
        <h4>Showing {{ $results->firstItem() }} - {{ $results->lastItem() }}</h4>
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
              <th scope="row">{{$loop->index + $results->firstItem()}}</th>
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
                    
                    <a href="{{ route('results.edit', ['id' => $result->results_id]) }}">EDIT</a><br>
                    <form action="{{ route('results.destroy', ['id' => $result->results_id]) }}" method="POST">
                      @csrf
                      {{method_field('DELETE')}}
                      <input type="submit" name="delete" value="DELETE">
                    </form>
      
                </td>
                
                </tr>
              
              @if ($results_east->lastPage() == $results->currentPage())
              <tr>
                <th>Total</th>
                <th> --- </th>
                <th> {{$totals['comp']}} </th>
                <th> {{$totals['grammar']}} </th>
                <th> {{$totals['english']}}</th>
                <th> {{$totals['insha']}} </th>
                <th> {{$totals['lugha']}} </th>
                <th> {{$totals['kiswahili']}} </th>
                <th> {{$totals['mathematics']}} </th>
                <th> {{$totals['science']}} </th>
                <th> {{$totals['ss']}} </th>
                <th> {{$totals['re']}} </th>
                <th> {{$totals['ssre']}} </th>
                <th> {{$totals['total']}} </th>
                <th> --- </th>
              </tr>
              <tr>
                <th>Mean</th>
                <th> --- </th>
                <th> {{$means['comp']}} </th>
                <th> {{$means['grammar']}} </th>
                <th> {{$means['english']}}</th>
                <th> {{$means['insha']}} </th>
                <th> {{$means['lugha']}} </th>
                <th> {{$means['kiswahili']}} </th>
                <th> {{$means['mathematics']}} </th>
                <th> {{$means['science']}} </th>
                <th> {{$means['ss']}} </th>
                <th> {{$means['re']}} </th>
                <th> {{$means['ssre']}} </th>
                <th> {{$means['total']}} </th>
                <th> --- </th>
              </tr>
              @endif 
              @endforeach
              
            @endif  
          </tbody>
        </table>
        <div class="links">
          {{$results_east->links()}}
          <a class="downloadBtn" href="{{ route('results.export', ['id' => $exam->exam_id]) }}"><i class="fa fa-download fa-lg" style="color: #ffffff; margin-right:5px"></i>Download</a>
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
           <label for="grammar">Grammar:</label>
           <input type="number" placeholder="Grammar" name="grammar" required>
           <label for="composition">Composition:</label>
           <input type="number" placeholder="Composition" name="composition" required>
           <label for="lugha">Lugha:</label>
           <input type="number" placeholder="Lugha" name="lugha" required>
           <label for="insha">Insha:</label>
           <input type="number" placeholder="Insha" name="insha" required>
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
          <h4>Showing {{ $results_west->firstItem() }} - {{ $results_west->lastItem() }}</h4>
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
                      
                      <a href="{{ route('results.edit', ['id' => $result->results_id]) }}">EDIT</a><br>
                      <form action="{{ route('results.destroy', ['id' => $result->results_id]) }}" method="POST">
                        @csrf
                        {{method_field('DELETE')}}
                        <input type="submit" name="delete" value="DELETE">
                      </form>
        
                  </td>
                  
                  </tr>
              
                @if ($results_west->lastPage() == $results_west->currentPage())
                <tr>
                  <th>Total</th>
                  <th> --- </th>
                  <th> {{$totals['comp']}} </th>
                  <th> {{$totals['grammar']}} </th>
                  <th> {{$totals['english']}}</th>
                  <th> {{$totals['insha']}} </th>
                  <th> {{$totals['lugha']}} </th>
                  <th> {{$totals['kiswahili']}} </th>
                  <th> {{$totals['mathematics']}} </th>
                  <th> {{$totals['science']}} </th>
                  <th> {{$totals['ss']}} </th>
                  <th> {{$totals['re']}} </th>
                  <th> {{$totals['ssre']}} </th>
                  <th> {{$totals['total']}} </th>
                  <th> --- </th>
                </tr>
                <tr>
                  <th>Mean</th>
                  <th> --- </th>
                  <th> {{$means['comp']}} </th>
                  <th> {{$means['grammar']}} </th>
                  <th> {{$means['english']}}</th>
                  <th> {{$means['insha']}} </th>
                  <th> {{$means['lugha']}} </th>
                  <th> {{$means['kiswahili']}} </th>
                  <th> {{$means['mathematics']}} </th>
                  <th> {{$means['science']}} </th>
                  <th> {{$means['ss']}} </th>
                  <th> {{$means['re']}} </th>
                  <th> {{$means['ssre']}} </th>
                  <th> {{$means['total']}} </th>
                  <th> --- </th>
                </tr>
                @endif
                @endforeach
                
              @endif  
            </tbody>
          </table>
          <div class="links">
            {{$results_west->links()}}
            <a class="downloadBtn" href="{{ route('results.export', ['id' => $exam->exam_id]) }}"><i class="fa fa-download fa-lg" style="color: #ffffff; margin-right:5px"></i>Download</a>
          </div>
        </div>
  </section>
  
  </section>



@endsection