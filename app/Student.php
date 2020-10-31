<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

 public function hasClass($class) {
     if($this->class()->where('class', $class)) {
          return true;
      }
      return false;
 }

 public function hasStream($stream) {
     if($this->class()->where('stream', $stream)) {
          return true;
      }
      return false;
 }
}
