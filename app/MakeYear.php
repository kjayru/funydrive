<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MakeYear extends Model
{
    protected $table = 'make_years';
    
    public function make(){
        return $this->belongsTo('App\Make');
    }

    public function modelos(){
        return $this->hasMany('App\Modelo');
    }
}
