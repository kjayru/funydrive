<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workshoporder extends Model
{
    protected $table ='WorkShopOrders';


    public function Workshopassociationorders(){
        return $this->hasMany('App\Workshopassociationorder','order_id');
    }

    public static function  random_str($length,$keyspace = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz') {
        $str = '';
        $max = mb_strlen($keyspace, '8bit') - 1;
        if ($max < 1) {
            throw new Exception('$keyspace must be at least two characters long');
        }
        for ($i = 0; $i < $length; ++$i) {
        
            if($i%5==0&&$i>0){

                $str .=("-");
        
            }
            $str .= $keyspace[random_int(0, $max)];
        }
        return $str;
    }
}