<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = "students";
    protected $fillable = [
        'first_name', 'last_name', 'photo', 'niveau', 'adresse'
    ];

    public function parent()
    {
        return $this->hasManyThrough(TheParent::class, StudentParent::class);
    }
}
