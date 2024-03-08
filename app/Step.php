<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    public function options(){
        return $this->hasMany(Option::class);
    }
    public function service(){
        return $this->belongsTo(Service::class);
    }
}
