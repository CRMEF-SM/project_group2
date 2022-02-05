<?php

namespace App\Http\Controllers;

use App\Models\TheParent;
use Illuminate\Http\Request;

class ParentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parents = TheParent::all();
        return response()->json($parents);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $parent = new TheParent();

        // image upload
        if($request->hasFile('photo')) {

        $allowedfileExtension=['pdf','jpg','png'];
        $file = $request->file('photo');
        $extenstion = $file->getClientOriginalExtension();
        $check = in_array($extenstion, $allowedfileExtension);

        if($check){
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            $parent->photo = $name;
        }
        }


        // text data
        $parent->first_name = $request->input('first_name');
        $parent->last_name = $request->input('last_name');
        $parent->cin = $request->input('cin');
        $parent->adresse = $request->input('adresse');
        $parent->phone = $request->input('phone');
        //$parent->carte_id = $request->input('carte_id');

        $parent->save();
        return response()->json($parent);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TheParent  $theParent
     * @return \Illuminate\Http\Response
     */
    public function show($theParent)
    {
        $parent = TheParent::find($theParent);
        return response()->json($parent);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TheParent  $theParent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$theParent)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'photo' => 'required',
            'cin' => 'required',
            'adresse' => 'required',
            'phone' => 'required'
         ]);

        $parent = TheParent::find($theParent);


        // image upload
        if($request->hasFile('photo')) {

            $allowedfileExtension=['pdf','jpg','png'];
            $file = $request->file('photo');
            $extenstion = $file->getClientOriginalExtension();
            $check = in_array($extenstion, $allowedfileExtension);

            if($check){
                $name = time() . $file->getClientOriginalName();
                $file->move('images', $name);
                $parent->photo = $name;
            }
            }
        // text Data
        $parent->first_name= $request->input('first_name');
        $parent->last_name = $request->input('last_name');
        $parent->phone = $request->input('phone');
        $parent->cin = $request->input('cin');
        $parent->adresse = $request->input('adresse');

        $parent->save();

        return response()->json($parent);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TheParent  $theParent
     * @return \Illuminate\Http\Response
     */
    public function destroy($theParent)
    {
        $parent = TheParent::find($theParent);
        $parent->delete();
        return response()->json('Parent Deleted Successfully');    }
}