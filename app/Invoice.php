<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public function employee(){
        return $this->belongsTo(Employee::class);
    }
    public function post(){
        return $this->belongsTo(Post::class);
    }
    public function postWithService(){
        return $this->post()->with('service');
    }
    public function employeeWithAddress(){
        return $this->employee()->with('address');
    }
}