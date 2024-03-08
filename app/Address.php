<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public function posts(){
        return $this->hasMany(Post::class);
    }
    public function employee(){
        return $this->hasOne(Employee::class);
    }
    public function employer(){
        return $this->hasOne(Employer::class);
    }
}
