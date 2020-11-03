<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Student extends Model
{
     //Table Name
     protected $table = 'students';
     //primarykey
     public $primaryKey = 'student_id';
     //timestamps
     public $timestamps = true;

     //relations
    public function class() {
     //student has a class
    return $this->belongsTo('App\Classroom');
 }

 public static function getStudents($id)
 {
      $students = DB::table('students')->select('upi','fname','sname','parent_names','parent_contact')->where('classroom_class_id', $id)->orderBy('student_id','asc')->get()->toArray();
      return $students;
 }

 
}
