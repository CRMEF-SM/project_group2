<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carte extends Model
{
    protected $table = "cartes";
    protected $fillable = [
        'student_id','parent_id'
    ];
}
