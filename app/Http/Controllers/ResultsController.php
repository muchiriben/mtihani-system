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
      
        //results code
        //east results
        $results_east = Results::where([
                                       ['exam_exam_id',$id],
                                       ['stream','East']
                                       ])->paginate(1);

        //west results                               
        $results_west = Results::where([
                                       ['exam_exam_id',$id],
                                       ['stream','West']
                                       ])->paginate(1);                               
        
        $results_east_calc = Results::where([['exam_exam_id',$id],['stream','East']]);
        $results_west_calc = Results::where([['exam_exam_id',$id],['stream','West']]);

        //totals
        $comp_total_east = $results_east_calc->sum('composition');
        $grammar_total_east = $results_east_calc->sum('grammar');       
        $eng_total_east = $results_east_calc->sum('english');
        $insha_total_east = $results_east_calc->sum('insha');
        $lugha_total_east = $results_east_calc->sum('lugha');
        $kisw_total_east = $results_east_calc->sum('kiswahili');
        $math_total_east = $results_east_calc->sum('mathematics');
        $scs_total_east = $results_east_calc->sum('science');
        $ss_total_east = $results_east_calc->sum('social_studies');
        $re_total_east = $results_east_calc->sum('religious_education');
        $ssre_total_east = $results_east_calc->sum('ss_re');
        $total_total_east = $results_east_calc->sum('total');

        //means
        $comp_mean_east = round($results_east_calc->avg('composition'),2);
        $grammar_mean_east = round($results_east_calc->avg('grammar'),2);       
        $eng_mean_east = round($results_east_calc->avg('english'),2);
        $insha_mean_east = round($results_east_calc->avg('insha'),2);
        $lugha_mean_east = round($results_east_calc->avg('lugha'),2);
        $kisw_mean_east = round($results_east_calc->avg('kiswahili'),2);
        $math_mean_east = round($results_east_calc->avg('mathematics'),2);
        $scs_mean_east = round($results_east_calc->avg('science'),2);
        $ss_mean_east = round($results_east_calc->avg('social_studies'),2);
        $re_mean_east = round($results_east_calc->avg('religious_education'),2);
        $ssre_mean_east = round($results_east_calc->avg('ss_re'),2);
        $total_mean_east = round($results_east_calc->avg('total'),2);
            
            $totals_east = array(
                'comp' => $comp_total_east,
                'grammar' => $grammar_total_east,
                'english' => $eng_total_east,
                'insha' => $insha_total_east,
                'lugha' => $lugha_total_east,
                'kiswahili' => $kisw_total_east,
                'mathematics' => $math_total_east,
                'science' => $scs_total_east,
                'ss' => $ss_total_east,
                're' => $re_total_east,
                'ssre' => $ssre_total_east,
                'total' => $total_total_east
            );
            
            $means_east = array(
                'comp' => $comp_mean_east,
                'grammar' => $grammar_mean_east,
                'english' => $eng_mean_east,
                'insha' => $insha_mean_east,
                'lugha' => $lugha_mean_east,
                'kiswahili' => $kisw_mean_east,
                'mathematics' => $math_mean_east,
                'science' => $scs_mean_east,
                'ss' => $ss_mean_east,
                're' => $re_mean_east,
                'ssre' => $ssre_mean_east,
                'total' => $total_mean_east
            );

            //west 
             //totals
        $comp_total_west = $results_west_calc->sum('composition');
        $grammar_total_west = $results_west_calc->sum('grammar');       
        $eng_total_west = $results_west_calc->sum('english');
        $insha_total_west = $results_west_calc->sum('insha');
        $lugha_total_west = $results_west_calc->sum('lugha');
        $kisw_total_west = $results_west_calc->sum('kiswahili');
        $math_total_west = $results_west_calc->sum('mathematics');
        $scs_total_west = $results_west_calc->sum('science');
        $ss_total_west = $results_west_calc->sum('social_studies');
        $re_total_west = $results_west_calc->sum('religious_education');
        $ssre_total_west = $results_west_calc->sum('ss_re');
        $total_total_west = $results_west_calc->sum('total');

        //means
        $comp_mean_west = round($results_west_calc->avg('composition'),2);
        $grammar_mean_west = round($results_west_calc->avg('grammar'),2);       
        $eng_mean_west = round($results_west_calc->avg('english'),2);
        $insha_mean_west = round($results_west_calc->avg('insha'),2);
        $lugha_mean_west = round($results_west_calc->avg('lugha'),2);
        $kisw_mean_west = round($results_west_calc->avg('kiswahili'),2);
        $math_mean_west = round($results_west_calc->avg('mathematics'),2);
        $scs_mean_west = round($results_west_calc->avg('science'),2);
        $ss_mean_west = round($results_west_calc->avg('social_studies'),2);
        $re_mean_west = round($results_west_calc->avg('religious_education'),2);
        $ssre_mean_west = round($results_west_calc->avg('ss_re'),2);
        $total_mean_west = round($results_west_calc->avg('total'),2);
            
            $totals_west = array(
                'comp' => $comp_total_west,
                'grammar' => $grammar_total_west,
                'english' => $eng_total_west,
                'insha' => $insha_total_west,
                'lugha' => $lugha_total_west,
                'kiswahili' => $kisw_total_west,
                'mathematics' => $math_total_west,
                'science' => $scs_total_west,
                'ss' => $ss_total_west,
                're' => $re_total_west,
                'ssre' => $ssre_total_west,
                'total' => $total_total_west
            );
            
            $means_west = array(
                'comp' => $comp_mean_west,
                'grammar' => $grammar_mean_west,
                'english' => $eng_mean_west,
                'insha' => $insha_mean_west,
                'lugha' => $lugha_mean_west,
                'kiswahili' => $kisw_mean_west,
                'mathematics' => $math_mean_west,
                'science' => $scs_mean_west,
                'ss' => $ss_mean_west,
                're' => $re_mean_west,
                'ssre' => $ssre_mean_west,
                'total' => $total_mean_west
            );
        
        
        return view('results.index')->with('exam', $exam)->with('students', $students)->with('classes', $classes)
                                    ->with('totals_east', $totals_east)->with('means_east', $means_east)
                                    ->with('totals_west', $totals_west)->with('means_west', $means_west)
                                    ->with('results_east',$results_east)->with('results_west',$results_west);
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
        return redirect('/results/' .$result->exam_exam_id)->with('success', 'Record Deleted');
    }

    public function exportIntoExcel(Request $request)
    {
        $exam = Exam::find($request->id);
        return Excel::download(new ResultsExport($request->id), $exam->exam_name.' Class '.$exam->exam_class.'.xlsx');
    }

    public function search()
    {
        $search_upi = $_GET['search'];
        $exam_id = $_GET['exam'];
        $results = Results::where([
            ['upi','LIKE', '%'.$search_upi.'%'],
            ['exam_exam_id', $exam_id]
            ])->get();

        return  view('results.search', compact('results'));
    }
}
