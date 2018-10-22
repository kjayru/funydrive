<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workshopresponse extends Model
{
    protected $table ='WorkShopResponses';

    public function workshoporder()
    {
        return $this->belongsTo('App\Workshoporder','order_id','order_id');
    }
}
