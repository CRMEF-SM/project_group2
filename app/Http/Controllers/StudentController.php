<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
        return response()->json($students);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $student = new Student();

        // image upload
        if($request->hasFile('photo')) {

        $allowedfileExtension=['pdf','jpg','png'];
        $file = $request->file('photo');
        $extenstion = $file->getClientOriginalExtension();
        $check = in_array($extenstion, $allowedfileExtension);

        if($check){
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            $student->photo = $name;
        }
        }


        // text data
        $student->first_name = $request->input('first_name');
        $student->last_name = $request->input('last_name');
        $student->adresse = $request->input('adresse');
        $student->niveau = $request->input('niveau');

        $student->save();
        return response()->json($student);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($student_id)
    {
        $student = Student::find($student_id);
        return response()->json($student);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $student_id)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'adresse' => 'required',
            'niveau' => 'required'
         ]);

        $student = Student::find($student_id);


        // image upload
        if($request->hasFile('photo')) {

            $allowedfileExtension=['pdf','jpg','png'];
            $file = $request->file('photo');
            $extenstion = $file->getClientOriginalExtension();
            $check = in_array($extenstion, $allowedfileExtension);

            if($check){
                $name = time() . $file->getClientOriginalName();
                $file->move('images', $name);
                $student->photo = $name;
            }
            }
        // text Data
        $student->first_name= $request->input('first_name');
        $student->last_name = $request->input('last_name');
        $student->niveau = $request->input('niveau');
        $student->adresse = $request->input('adresse');

        $student->save();

        return response()->json($student);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($student_id)
    {
        $student = Student::find($student_id);
        $student->delete();
        return response()->json('student Deleted Successfully'); 
    }
}