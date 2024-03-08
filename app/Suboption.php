<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suboption extends Model
{
    public function option()
    {
        return $this->belongsTo(Option::class);
    }
    public function posts()
    {
        return $this->belongsToMany(Post::class,'suboption_post');
    }
}
