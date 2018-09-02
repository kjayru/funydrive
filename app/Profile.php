<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function dayhours()
    {
        return $this->hasMany('App\Dayhour');
    }

    public function vacations()
    {
        return $this->hasMany('App\Vacation');
    }

    public function requirements()
    {
        return $this->hasMany('App\Requirement');
    }
}
