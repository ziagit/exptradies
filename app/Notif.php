<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notif extends Model
{
    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('read_at')->withTimestamps();
    }
}
