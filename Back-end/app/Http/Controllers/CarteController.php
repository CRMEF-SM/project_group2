<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carte;
use App\Models\TheParent;
use App\Models\Student;
use App\Models\StudentParent;
use App\Models\Waiting;
use Exception;

class CarteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cartes = Carte::all();
        return response()->json($cartes);
    }

    public function is_waiting($carte_id)
    {
        try {
            $carte = Carte::find($carte_id);
            $count = Waiting::where('went_at', null)->where('parent_id', $carte->parent_id)->count();
            if ($count == 0) return response()->json(['message' => false]);
            return response()->json(['is_waiting' => true]);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $carte = new Carte();


        // text data
        $carte->parent_id = $request->input('parent_id');

        $carte->save();
        return response()->json($carte);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($carte_id)
    {
        $carte = carte::find($carte_id);
        if ($carte) {
            $parent = TheParent::find($carte->parent_id);
            $student_parent = StudentParent::where('parent_id', $carte->parent_id)->get();
            if (count($student_parent) == 1) {
                $student = Student::find($student_parent[0]['student_id']);
                $data = ['id_carte' => $carte_id, 'student' => $student, 'parent' => $parent];
                return response()->json($data);
            } else {
                return response()->json('oops somethings wrong !!!');
            }
        } else
            return response()->json('oops somethings wrong !!!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $carte_id)
    {
        $this->validate($request, [
            'parent_id' => 'required',
        ]);

        $carte = Carte::find($carte_id);

        // text Data
        $carte->parent_id = $request->input('parent_id');

        $carte->save();

        return response()->json($carte);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($carte_id)
    {
        $carte = Carte::find($carte_id);
        $carte->delete();
        return response()->json('carte Deleted Successfully');
    }
}
