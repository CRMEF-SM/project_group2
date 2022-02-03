<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TheParent extends Model
{
    protected $table = "parents";
    public function kids()
    {
        return $this->hasMany(Student::class);
    }
    public function carte()
    {
        return $this->hasOne();
    }
}
