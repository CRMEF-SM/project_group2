<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function parent()
    {
        return $this->belongsToMany(TheParent::class);
    }
}
