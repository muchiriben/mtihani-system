<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AfricasTalking\SDK\AfricasTalking;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Student;
use App\Classroom;

class SmsController extends Controller
{
    function index(){
        return view('sms.index');
    }

    function messageAll(){
        return view('sms.allParents');
    }

    function messageBom(){
        return view('sms.bom');
    }

    function messageSpecific(){
        return view('sms.specificClass');
    }

    function messageTeachers(){
        return view('sms.teachers');
    }


    function send_sms(Request $request) {
        $this->validate($request, [
            'title' => 'required',
            'message' => 'required',
        ]);

        $title = $request->input('title');
        $message = $request->input('message');


        $contacts = DB::table('students')->pluck('parent_contact')->implode(',');

 // Set your app credentials
 $username   = "school-app";
 $apiKey     = "f3733bc49f4d0720c534e6885f7d2d502a89abc05dccc72ff73498e0836e1c5f";
 
 // Initialize the SDK
 $AT         = new AfricasTalking($username, $apiKey);
 
 // Get the SMS service
 $sms        = $AT->sms();
 
 // Set the numbers you want to send to in international format
 $recipients = $contacts;
 
 // Set your message
 $message = "FROM:HEADTEACHER/SECRETARY \n\n Subject:".$title. "\n" .$message;
 
 // Set your shortCode or senderId
 $from       = "";
 
 try {
     // Thats it, hit send and we'll take care of the rest
     $result = $sms->send([
         'to'      => $recipients,
         'message' => $message,
         'from'    => $from
     ]);
 } catch (Exception $e) {
     echo "Error: ".$e->getMessage();
 }

        return redirect('/sms')->with('success', 'Message Sent Successfully');
    }


    //send message  to specific class parents
    function send_specific(Request $request) {
        $this->validate($request, [
            'class' => 'required',
            'title' => 'required',
            'message' => 'required'
        ]);

        $class = $request->input('class');
        $title = $request->input('title');
        $message = $request->input('message');

        //get contacts
      $class_ids = DB::table('classes')->where('class', $class)->pluck('class_id');
      $contacts = Student::whereIn('classroom_class_id', $class_ids)->pluck('parent_contact')->implode(',');


 // Set your app credentials
 $username   = "school-app";
 $apiKey     = "f3733bc49f4d0720c534e6885f7d2d502a89abc05dccc72ff73498e0836e1c5f";
 
 // Initialize the SDK
 $AT         = new AfricasTalking($username, $apiKey);
 
 // Get the SMS service
 $sms        = $AT->sms();
 
 // Set the numbers you want to send to in international format
 $recipients = $contacts;
 
 // Set your message
 $message = "FROM:HEADTEACHER/SECRETARY\n\nSubject:".$title. "\n" .$message;
 
 // Set your shortCode or senderId
 $from       = "";
 
 try {
     // Thats it, hit send and we'll take care of the rest
     $result = $sms->send([
         'to'      => $recipients,
         'message' => $message,
         'from'    => $from
     ]);
 } catch (Exception $e) {
     echo "Error: ".$e->getMessage();
 }

        return redirect('/sms')->with('success', 'Message Sent Successfully');
    }
}
