<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function getAllStudents(Request $request)
    {
        $data = Student::all();
        return $data;
    }
    public function saveStudent(Request $request)
    {

        $student = Student::create([
            "name" => $request->name,
            "address" => $request->address,
            "email" => $request->email,
            "phone" => $request->phone,
        ]);
        return redirect()->back()->with('success', 'Student Created Successfully!');
        // return response()->json([
        //     "data"=>$student,
        //     "message"=>"Student Created Successfully !"
        // ],200);
    }

    public function editStudents(Request $request)
    {

        $student = Student::find($request->id);
        // dd($student);
        return response()->json($student);
    }
   public function updateStudent(Request $request) {

        $student=Student::where("id",$request->id)->update([
            "name"=>$request->name,
            "address"=>$request->address,
            "email"=>$request->email,
            "phone"=>$request->phone
        ]);
        
        return response()->json([
            "data"=>$student,
            "message"=>"Student data updated successfully"
        ]);
        // redirect('/home');
    }

    public function deleteStudent(Request $request){
        $student=Student::find($request->id)->delete();
        // dd($student);
        return response()->json([
            "data"=>$student,
            "message"=>"Student Deleted Successfully"
        ]);
    }
}
