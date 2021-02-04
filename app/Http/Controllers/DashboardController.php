<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Exam;
use App\Student;
use App\Results;
use App\Classroom;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $classes = Classroom::all();
        $students = Student::all();
        $admin_users = User::all();
        $exams = Exam::all()->where('exam_class',8)->sortByDesc('created_at')->take(5);
        $recent_exam = Exam::latest()->first();
        if($recent_exam){
            $top_perfomers = Exam::find($recent_exam->exam_id)->results->sortByDesc('total')->take(10);
        }

        return view('/dashboard')->with('students',$students)->with('admin_users', $admin_users)->with('exams',$exams)
                                 ->with('top_perfomers',$top_perfomers)->with('classes', $classes);
    }
}
