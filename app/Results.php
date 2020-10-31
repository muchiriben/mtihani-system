<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
