<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carte extends Model
{
    protected $table = "cartes";
    protected $fillable = [
        'parent_id'
    ];
    public function parent()
    {
        return $this->belongsTo(TheParent::class, "parent_id");
    }
}
