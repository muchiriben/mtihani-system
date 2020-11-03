<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Classroom;
use App\Exports\StudentsExport;
use Excel;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
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
            'class_id' => 'required',
            'upi' => 'required',
            'fname' => 'required',
            'sname' => 'required',
            'parent_names' => 'required',
            'parent_contact' => 'required'
        ]);

        $student = new Student;
        //$student->class_id = $request->input('class_id');
        $student->upi = $request->input('upi');
        $student->fname = $request->input('fname');
        $student->sname = $request->input('sname');
        $student->parent_names = $request->input('parent_names');
        $student->parent_contact = $request->input('parent_contact');

        $class = Classroom::find($request->input('class_id'));
        $class->students()->save($student);

        return redirect('/classes/'.$class->class_id)->with('success', 'Student Registerd Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::find($id);

        return view('students.edit')->with('student', $student);
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
            'upi' => 'required',
            'fname' => 'required',
            'sname' => 'required',
            'parent_names' => 'required',
            'parent_contact' => 'required'
        ]);

        $student = Student::find($id);
        $student->upi = $request->input('upi');
        $student->fname = $request->input('fname');
        $student->sname = $request->input('sname');
        $student->parent_names = $request->input('parent_names');
        $student->parent_contact = $request->input('parent_contact');
        $student->save();

        return redirect('/classes/'.$student->class_id)->with('success', 'Student Record Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::find($id);
        $student->delete();
        return redirect('/classes/'.$student->class_id)->with('success', 'Student Record Deleted');
    }

    public function exportIntoExcel(Request $request)
    {
        $class = Classroom::find($request->id);
        return Excel::download(new StudentsExport($request->id), $class->class.' '.$class->stream.'.xlsx');
    }
}
