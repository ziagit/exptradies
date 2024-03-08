<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function userWithRole()
    {
        return $this->user()->with('roles');
    }

    public function creatorUser()
    {
        return $this->belongsTo(User::class, 'creator');
    }

}
