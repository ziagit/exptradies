<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Galery extends Model
{
    public function employees(){
        return $this->belongsTo(Employee::class);
    }
}
