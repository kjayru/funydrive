<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gestor extends Model
{
    public static function conexion(){
        $mysqli = new mysqli("35.195.132.92", "wavydrive", "*WavyDrive2018*", "funydrive");
        return $mysqli;
        
    }
}
