<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Make extends Model
{
    public function makeyears(){
        return $this->hasMany('App\MakeYear');
    }

    
}
