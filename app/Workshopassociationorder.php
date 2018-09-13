<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workshopassociationorder extends Model
{
     protected $table = "WorkShopAssociationOrders";


     public function workshoporder(){
         return $this->belongsTo('App\Workshoporder','order_id');
     }
}
