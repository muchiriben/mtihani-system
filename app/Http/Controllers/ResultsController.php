<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Results;
use App\Exam;
use App\Classroom;
use App\Student;
use App\Exports\ResultsExport;
use Excel;

class ResultsController extends Controller
{
    public function index($id)
    {
        $exam = Exam::find($id);
        $classes = Classroom::all();
        $students = Student::all();
       //$results = Exam::find($id)->results;

        $results = Results::where('exam_exam_id',$id)->paginate(1);
        $results_east = Results::where([
                                       ['exam_exam_id',$id],
                                       ['stream','East']
                                       ])->paginate(1);

        //west results                               
        $results_west = Results::where([
                                       ['exam_exam_id',$id],
                                       ['stream','West']
                                       ])->paginate(1);                               
        

        //totals
        $comp_total = Results::where('exam_exam_id',$id)->sum('composition');
        $grammar_total = Results::where('exam_exam_id',$id)->sum('grammar');       
        $eng_total = Results::where('exam_exam_id',$id)->sum('english');
        $insha_total = Results::where('exam_exam_id',$id)->sum('insha');
        $lugha_total = Results::where('exam_exam_id',$id)->sum('lugha');
        $kisw_total = Results::where('exam_exam_id',$id)->sum('kiswahili');
        $math_total = Results::where('exam_exam_id',$id)->sum('mathematics');
        $scs_total = Results::where('exam_exam_id',$id)->sum('science');
        $ss_total = Results::where('exam_exam_id',$id)->sum('social_studies');
        $re_total = Results::where('exam_exam_id',$id)->sum('religious_education');
        $ssre_total = Results::where('exam_exam_id',$id)->sum('ss_re');
        $total_total = Results::where('exam_exam_id',$id)->sum('total');

        //means
        $comp_mean = round(Results::where('exam_exam_id',$id)->avg('composition'),2);
        $grammar_mean = round(Results::where('exam_exam_id',$id)->avg('grammar'),2);       
        $eng_mean = round(Results::where('exam_exam_id',$id)->avg('english'),2);
        $insha_mean = round(Results::where('exam_exam_id',$id)->avg('insha'),2);
        $lugha_mean = round(Results::where('exam_exam_id',$id)->avg('lugha'),2);
        $kisw_mean = round(Results::where('exam_exam_id',$id)->avg('kiswahili'),2);
        $math_mean = round(Results::where('exam_exam_id',$id)->avg('mathematics'),2);
        $scs_mean = round(Results::where('exam_exam_id',$id)->avg('science'),2);
        $ss_mean = round(Results::where('exam_exam_id',$id)->avg('social_studies'),2);
        $re_mean = round(Results::where('exam_exam_id',$id)->avg('religious_education'),2);
        $ssre_mean = round(Results::where('exam_exam_id',$id)->avg('ss_re'),2);
        $total_mean = round(Results::where('exam_exam_id',$id)->avg('total'),2);
            
            $totals = array(
                'comp' => $comp_total,
                'grammar' => $grammar_total,
                'english' => $eng_total,
                'insha' => $insha_total,
                'lugha' => $lugha_total,
                'kiswahili' => $kisw_total,
                'mathematics' => $math_total,
                'science' => $scs_total,
                'ss' => $ss_total,
                're' => $re_total,
                'ssre' => $ssre_total,
                'total' => $total_total
            );
            
            $means = array(
                'comp' => $comp_mean,
                'grammar' => $grammar_mean,
                'english' => $eng_mean,
                'insha' => $insha_mean,
                'lugha' => $lugha_mean,
                'kiswahili' => $kisw_mean,
                'mathematics' => $math_mean,
                'science' => $scs_mean,
                'ss' => $ss_mean,
                're' => $re_mean,
                'ssre' => $ssre_mean,
                'total' => $total_mean
            );
        
        
        return view('results.index')->with('results', $results)->with('exam', $exam)->with('students', $students)->with('classes', $classes)
                                    ->with('totals', $totals)->with('means', $means)->with('results_east',$results_east)->with('results_west',$results_west);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'upi' => 'required',
            'grammar' => 'required',
            'composition' => 'required',
            'insha' => 'required',
            'lugha' => 'required',
            'mathematics' => 'required',
            'science' => 'required',
            'social_studies' => 'required',
            'religious_education' => 'required'
        ]);

        $results = new Results;
        $results->stream = $request->input('stream');
        $results->upi = $request->input('upi');

        $results->composition = $request->input('composition');
        $results->grammar = $request->input('grammar');
        $results->english = round((($results->composition + $results->grammar)/90)*100);

        $results->insha = $request->input('insha');
        $results->lugha = $request->input('lugha');
        $results->kiswahili = round((($results->insha + $results->lugha)/90)*100);

        $results->mathematics = $request->input('mathematics');
        $results->science = $request->input('science');

        $results->social_studies = $request->input('social_studies');
        $results->religious_education = $request->input('religious_education');
        $results->ss_re = round((($results->social_studies + $results->religious_education)/90)*100);

        $results->total = $results->english + $results->kiswahili + $results->mathematics + $results->science + $results->ss_re;

        $exam_id = $request->input('exam_id');
        $exam = Exam::find($exam_id);
        $exam->results()->save($results);

        return redirect('/results/' .$exam_id)->with('success', 'Record Created Successfully');
    }

    public function edit($id)
    {
        $result = Results::find($id);

        return view('results.edit')->with('result', $result);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'grammar' => 'required',
            'composition' => 'required',
            'insha' => 'required',
            'lugha' => 'required',
            'mathematics' => 'required',
            'science' => 'required',
            'social_studies' => 'required',
            'religious_education' => 'required'
        ]);

        $results = Results::find($id);
        $results->composition = $request->input('composition');
        $results->grammar = $request->input('grammar');
        $results->english = round((($results->composition + $results->grammar)/90)*100);

        $results->insha = $request->input('insha');
        $results->lugha = $request->input('lugha');
        $results->kiswahili = round((($results->insha + $results->lugha)/90)*100);

        $results->mathematics = $request->input('mathematics');
        $results->science = $request->input('science');

        $results->social_studies = $request->input('social_studies');
        $results->religious_education = $request->input('religious_education');
        $results->ss_re = round((($results->social_studies + $results->religious_education)/90)*100);

        $results->total = $results->english + $results->kiswahili + $results->mathematics + $results->science + $results->ss_re;
        $results->save();

        return redirect('/results/' .$results->exam_exam_id)->with('success', 'Record Edited Successfully');
    }

    public function destroy($id)
    {
        $result = Results::find($id);
        $result->delete();
        return redirect('/results/' .$result->exam_id)->with('success', 'Record Deleted');
    }

    public function exportIntoExcel(Request $request)
    {
        $exam = Exam::find($request->id);
        return Excel::download(new ResultsExport($request->id), $exam->exam_name.' Class '.$exam->exam_class.'.xlsx');
    }
}
