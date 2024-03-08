<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Earning extends Model
{
    public function post(){
        return $this->belongsTo(Post::class);
    }
    public function employerPost(){
        return $this->post()->with('employee','address','service');
    }
    public function employee(){
        return $this->belongsTo(Employee::class);
    }
}
