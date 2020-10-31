<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exam;
use App\Classroom;
use App\Results;

class ExamsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $class = $id;
        $exams = Exam::where('exam_class', $id)->paginate(12);
        return view('exams.index')->with('exams', $exams)->with('class', $class);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'exam_name' => 'required',
            'exam_class' => 'required',
        ]);

        $exam = new Exam;
        $exam->exam_name = $request->input('exam_name');
        $exam->exam_class = $request->input('exam_class'); 
        $exam->save();

        return redirect('/exams/' .$exam->exam_class)->with('success', 'Exam Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $exam = Exam::find($id);
        $results = Results::where('exam_id', $id)->paginate(12);
        return view('exams.specificExam')->with('results', $results)->with('exam', $exam);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'exam_name' => 'required'
        ]);

        $exam = Exam::find($id);
        $exam->exam_name = $request->input('exam_name');
        $exam->save();

        return redirect('/results/' .$exam->exam_id)->with('success', 'Exam Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
