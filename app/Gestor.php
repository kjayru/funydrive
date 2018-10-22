<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gestor extends Model
{
    public static function conexion(){
        $con = mysqli_connect("35.195.132.92", "wavydrive", "*WavyDrive2018*", "funydrive");
        
        $select="Select * from usuario";
        $result = $con->query($select);
        while($row  = $result->fetch_assoc()){
            $row['email']."<br>";
        }
       
        
        
    }
}
