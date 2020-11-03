<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classroom;
use App\Student;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = Classroom::all();
        return view('classes.index')->with('classes', $classes);
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
            'class' => 'required',
            'class-stream' => 'required',
            'year-of' => 'required',
            'class-teacher' => 'required'
        ]);

        $class = new Classroom;
        $class->class = $request->input('class');
        $class->stream = $request->input('class-stream');
        $class->year_of = $request->input('year-of');
        $class->class_teacher = $request->input('class-teacher');
        
        $class->save();

        return redirect('/classes')->with('success', 'Class Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $class = Classroom::find($id);
        $students = Student::where('classroom_class_id', $id)->paginate(15);

        return view('classes.specificClass')->with('class', $class)->with('students', $students);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $class = Classroom::find($id);

        return view('classes.specificClass')->with('class', $class);
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
            'class' => 'required',
            'class-stream' => 'required',
            'year-of' => 'required',
            'class-teacher' => 'required'
        ]);

        $class = Classroom::find($id);
        $class->class = $request->input('class');
        $class->stream = $request->input('class-stream');
        $class->year_of = $request->input('year-of');
        $class->class_teacher = $request->input('class-teacher');
        
        $class->save();

        return redirect('/classes/'.$class->class_id)->with('success', 'Class Updated');
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
