<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function posts()
    {
        return $this->belongsToMany(Post::class)->withPivot('status','commission')->withTimestamps();
    }
    public function address()
    {
        return $this->belongsTo(Address::class);
    }
    public function businessAddresses()
    {
        return $this->hasMany(BusinessAddress::class);
    }
    public function services()
    {
        return $this->belongsToMany(Service::class);
    }
    public function cities()
    {
        return $this->belongsToMany(City::class);
    }
    public function invoice(){
        return $this->hasOne(Invoice::class);
    }
    public function galeries(){
        return $this->hasMany(Galery::class);
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }
}
