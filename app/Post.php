<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function employees(){
        return $this->belongsToMany(Employee::class)->withPivot('status','commission')->withTimestamps();
    }
    public function employee(){
        return $this->belongsTo(Employee::class);
    }
    public function employeeWithUser(){
        return $this->employee()->with('user');
    }
    public function address(){
        return $this->belongsTo(Address::class);
    }
    public function service(){
        return $this->belongsTo(Service::class);
    }
    public function options(){
        return $this->belongsToMany(Option::class);
    }
    public function suboptions(){
        return $this->belongsToMany(Suboption::class,'suboption_post');
    }
    public function earning(){
        return $this->hasOne(Earning::class);
    }
    public function images(){
        return $this->belongsToMany(Image::class);
    }
    public function invoice(){
        return $this->hasOne(Invoice::class);
    }
}
