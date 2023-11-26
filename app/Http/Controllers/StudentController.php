<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Students;

class StudentController extends Controller
{
    public function studentlist(Request $request){
        $list = Students::get();
        return view('student.list', compact('list'));
    }  
    public function student_add(Request $request){
        return view('student.add');
    }
    public function editStudent(Request $request){
        $StudentID = decrypt($request->segment(2));
        $studentInfo= Students::find($StudentID);
        return view('student.add', compact('StudentID' , 'studentInfo'));
    }
    
    public function x_removeStudentByID(Request $request){
        $alert = [
            'message' => 'Unable to do action',
            'result' => false
        ];

        $StudentID = decrypt($request->StudentID);

        $isDeleted = Students::where('id', $StudentID)->delete();
        if($isDeleted){
            $alert = [
                'message' => 'Student has been Deleted!',
                'result' => true,
                'icon' => 'success',
                'title' => 'success'
            ];
            
        }

        return json_encode($alert);
    }
}
