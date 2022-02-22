<?php

namespace App\Http\Controllers;

use App\Models\StudentParent;
use App\Models\Student;
use App\Models\TheParent;
use Illuminate\Http\Request;

class StudentParentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students_parents = StudentParent::all();
        return response()->json($students_parents);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $student_parent = new StudentParent();

        // text data
        $student_parent->parent_id = $request->input('parent_id');
        $student_parent->student_id = $request->input('student_id');

        $student_parent->save();
        return response()->json($student_parent);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StudentParent  $studentParent
     * @return \Illuminate\Http\Response
     */
    public function show($studentParent_id)
    {
        $student_parent = StudentParent::find($studentParent_id);
        $student = Student::find($student_parent->student_id);
        $parent = TheParent::find($student_parent->parent_id);
        $data = ['id' => $studentParent_id ,'parent' => $parent ,'student' => $student];
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StudentParent  $studentParent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $studentParent_id)
    {
        $this->validate($request, [
            'student_id' => 'required',
            'parent_id' => 'required'
         ]);

        $student_parent = StudentParent::find($studentParent_id);


        // text Data
        $student_parent->parent_id= $request->input('parent_id');
        $student_parent->student_id = $request->input('student_id');

        $student_parent->save();

        return response()->json($student_parent);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudentParent  $studentParent
     * @return \Illuminate\Http\Response
     */
    public function destroy($studentParent_id)
    {
        $student_parent = StudentParent::find($studentParent_id);
        $student_parent->delete();
        return response()->json('student_parent Deleted Successfully'); 
    }
}