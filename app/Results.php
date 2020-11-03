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

      public static function getResults($id)
 {
      $results = DB::table('Results')->select('upi','composition','grammar','english','insha','lugha','kiswahili','mathematics','science','social_studies','religious_education','ss_re')->where('exam_exam_id', $id)->orderBy('results_id','asc')->get()->toArray();
      return $results;
 }
}
