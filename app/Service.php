<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function steps()
    {
        return $this->hasMany(Step::class);
    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function commission()
    {
        return $this->hasOne(Commission::class);
    }
    public function employees()
    {
        return $this->belongsToMany(Employee::class);
    }
}
