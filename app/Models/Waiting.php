<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Waiting extends Model
{
    protected $fillable = [
        'student_id', 'parent_id'
    ];
    public function parent()
    {
        return $this->belongsTo(TheParent::class, "parent_id");
    }
    public function student()
    {
        return $this->belongsTo(Student::class, "student_id");
    }
}
