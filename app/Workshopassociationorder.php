<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workshopassociationorder extends Model
{
     protected $table = "WorkShopAssociationOrders";

     public function workshoporder(){
         return $this->hasOne('App\Workshoporder','order_id','order_id');
     }
}
