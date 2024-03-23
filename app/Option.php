<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    public function step()
    {
        return $this->belongsTo(Step::class);
    }
    public function suboptions(){
        return $this->hasMany(Suboption::class);
    }
    public function posts()
    {
        return $this->belongsToMany(Post::class)->withPivot('custom');
    }
}
