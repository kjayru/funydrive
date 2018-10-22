<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
   

    public function workshoporder(){
        return $this->belongsTo('App\Workshoporder','order_id','order_id');
    }
}
