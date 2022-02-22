<?php

namespace App\Http\Controllers;

use App\Models\Carte;
use App\Models\Student;
use App\Models\TheParent;
use App\Models\Waiting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    public function count($table)
    {
        if ($table == "students")
            return response()->json(['status' => 'success', 'count' => Student::all()->count()]);
        else if ($table == "parents")
            return response()->json(['status' => 'success', 'count' => TheParent::all()->count()]);
        else if ($table == "cartes")
            return response()->json(['status' => 'success', 'count' => Carte::all()->count()]);
        else if ($table == "waiting")
            return response()->json(['status' => 'success', 'count' => Waiting::all()->count()]);
        else if ($table == "late_parents")
            return response()->json(['status' => 'success', 'count' => 0]);
        else
            return response()->json(['status' => 'error', 'message' => 'table not found']);
    }
}
