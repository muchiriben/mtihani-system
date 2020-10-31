<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Results;
use App\Exam;
use App\Classroom;
use App\Student;

class ResultsController extends Controller
{
    public function index($id)
    {
        $exam = Exam::find($id);
        $results = Exam::find($id)->results;
        $classes = Classroom::all();
        $students = Student::all();
        return view('results.index')->with('results', $results)->with('exam', $exam)->with('students', $students)->with('classes', $classes);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'upi' => 'required',
            'grammah' => 'required',
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
        $results->grammah = $request->input('grammah');
        $results->composition = $request->input('composition');
        $results->insha = $request->input('insha');
        $results->lugha = $request->input('lugha');
        $results->mathematics = $request->input('mathematics');
        $results->science = $request->input('science');
        $results->social_studies = $request->input('social_studies');
        $results->religious_education = $request->input('religious_education');

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
            'grammah' => 'required',
            'composition' => 'required',
            'insha' => 'required',
            'lugha' => 'required',
            'mathematics' => 'required',
            'science' => 'required',
            'social_studies' => 'required',
            'religious_education' => 'required'
        ]);

        $results = Results::find($id);
        $results->grammah = $request->input('grammah');
        $results->composition = $request->input('composition');
        $results->insha = $request->input('insha');
        $results->lugha = $request->input('lugha');
        $results->mathematics = $request->input('mathematics');
        $results->science = $request->input('science');
        $results->social_studies = $request->input('social_studies');
        $results->religious_education = $request->input('religious_education');
        $results->save();

        return redirect('/results/' .$results->exam_id)->with('success', 'Record Edited Successfully');
    }

    public function destroy($id)
    {
        $result = Results::find($id);
        $result->delete();
        return redirect('/results/' .$result->exam_id)->with('success', 'Record Deleted');
    }
}
