<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
     //Table Name
     protected $table = 'classes';
     //primarykey
     public $primaryKey = 'class_id';
     //timestamps
     public $timestamps = true;

     public function students() { 
          //a class can have many students
         return $this->hasMany('App\Student');
      }
}
