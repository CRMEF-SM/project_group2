<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TheParent extends Model
{
    protected $table = "parents";
    protected $fillable = [
        'first_name', 'last_name', 'photo', 'cin', 'adresse', 'phone', 'carte_id'
    ];
    public function kids()
    {
        return $this->hasManyThrough(Student::class, StudentParent::class);
    }
    public function carte()
    {
        return $this->hasOne(Carte::class);
    }
}
