<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Results extends Model
{
     //Table Name
     protected $table = 'results';
     //primarykey
     public $primaryKey = 'results_id';
     //timestamps
     public $timestamps = true;

     public function exam() {
          //student has a class
         return $this->belongsTo('App\Exam');
      }

      public static function getResults($id, $stream)
 {
      $results = DB::table('results')
                ->join('students', 'results.upi', '=', 'students.upi')
                  ->select('students.fname','students.sname','composition','grammar','english','insha','lugha','kiswahili','mathematics','science','social_studies','religious_education','ss_re','total')
                 ->where([
                      'exam_id' => $id,
                      'stream' => $stream
                      ])
                 ->orderBy('total','desc')->get()->toArray();
      return $results;
 }
}
