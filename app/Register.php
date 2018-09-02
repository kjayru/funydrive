<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function phones()
    {
        return $this->hasMany('App\Phone');
    }

    public function photos()
    {
        return $this->hasMany('App\photo');
    }
    public function service()
    {
        return $this->belongsTo('App\Service','service_id');
    }

    public function subservice()
    {
        return $this->belongsTo('App\Service','subservice_id');
    }
}
