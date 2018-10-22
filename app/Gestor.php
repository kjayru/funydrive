<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gestor extends Model
{
    public static function conexion(){
        $con = mysqli_connect("35.195.132.92", "wavydrive", "*WavyDrive2018*", "funydrive");
        
        $select="select * from usuarios";
        $result = $con->query($select);
  
        dd($result);
        
    }
}
