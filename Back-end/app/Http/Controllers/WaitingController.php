<?php

namespace App\Http\Controllers;

use App\Models\Carte;
use App\Models\Waiting;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\StudentParent;

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

    public function arrived($id)
    {
        $carte = Carte::findOrFail($id);
        $parent = $carte->parent;
        //$kids = $parent->kids;
        $student_parent = StudentParent::where('parent_id',$carte->parent_id)->get();
        $kids = Student::find($student_parent[0]['student_id']);

        $waiting = new Waiting();
        $waiting->parent_id  = $parent->id;
        $waiting->student_id = $kids->id;
        $waiting->arrived_at = date("Y-m-d h:i:s");
        $waiting->save();

        return response()->json(['status' => 'success', 'data' => [
            'parent' => $parent,
            'kids' => $kids
        ]]);
    }

    public function went($id)
    {
        $carte = Carte::findOrFail($id);
        $parent = $carte->parent;
        //$kids = $parent->kids;
        $student_parent = StudentParent::where('parent_id',$carte->parent_id)->get();
        $kids = Student::find($student_parent[0]['student_id']);

        //update went time
        Waiting::where('student_id',$kids->id)->update(['went_at'=> date("Y-m-d h:i:s")]);
        $waiting = Waiting::where('student_id',$kids->id)->get();

        return response()->json(['status' => 'success', 'data' => [
            'parent' => $parent,
            'kids' => $kids,
            'arrived_at' => $waiting[0]['arrived_at'],
            'went_at' => $waiting[0]['went_at']
        ]]);
    }


    public function waiting_list()
    {
        $waiting_list = Waiting::all()->where('went_at',null);
        $data = array();
        foreach ($waiting_list as $wait) {
            $val['parent']= $wait->parent;
            $val['student']= $wait->student;
            $val['arrived_at'] = $wait->arrived_at;
            $val['went_at'] = $wait->went_at;
            array_push($data, $val);
        }
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($student_id)
    {
        $waiting = Waiting::where('student_id', $student_id)->get();

        if (count($waiting) == 1) {
            return response()->json('the student waiting');
        } else {
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
    public function update(Request $request, $student_id)
    {
        $this->validate($request, [
            'student_id' => 'required',
            'parent_id' => 'required'
        ]);

        $wait = Waiting::where('student_id', $student_id)->get()[0];
        $waiting = Waiting::find($wait['id']);
        // text Data
        $waiting->parent_id = $request->input('parent_id');
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
