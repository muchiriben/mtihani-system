<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
     //Table Name
     protected $table = 'exams';
     //primarykey
     public $primaryKey = 'exam_id';
     //timestamps
     public $timestamps = true;

     public function results() { 
          //an exam can have many results
         return $this->hasMany('App\Results');
      }
}
