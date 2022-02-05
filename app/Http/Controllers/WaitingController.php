<?php

namespace App\Http\Controllers;

use App\Models\Waiting;
use Illuminate\Http\Request;

class WaitingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $waiting = Waiting::all();
        return response()->json($waiting);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $waiting = new Waiting();

        // text data
        $waiting->parent_id = $request->input('parent_id');
        $waiting->student_id = $request->input('student_id');

        $waiting->save();
        return response()->json($waiting);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($student_id)
    {
        $waiting = Waiting::where('student_id' ,$student_id)->get();
        
        if(count($waiting)==1)
        {
            return response()->json('the student waiting');
        }
        else
        {
            return response()->json('the student not waiting');
        }
        
        
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$student_id)
    {
        $this->validate($request, [
            'student_id' => 'required',
            'parent_id' => 'required'
         ]);

        $wait = Waiting::where('student_id', $student_id)->get()[0];
        $waiting = Waiting::find($wait['id']);
        // text Data
        $waiting->parent_id= $request->input('parent_id');
        $waiting->student_id = $request->input('student_id');

        $waiting->save();

        return response()->json($waiting);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($student_id)
    {
        $wait = Waiting::where('student_id', $student_id)->get()[0];
        $waiting = Waiting::find($wait['id']);
        $waiting->delete();
        return response()->json('student Deleted from waiting table Successfully'); 
    }
}
