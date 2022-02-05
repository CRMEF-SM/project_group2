<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TheParent extends Model
{
    protected $table = "parents";
    protected $fillable = [
        'first_name','last_name','photo','cin','adresse','phone'
    ];
    public function kids()
    {
        return $this->hasMany(Student::class);
    }
    public function carte()
    {
        return $this->hasOne();
    }
}
