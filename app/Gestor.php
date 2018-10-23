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
           $dispositivos[] = array('email'=> $row['email'],'reg_id'=>$row['reg_id']);
        }
       
       

        return $dispositivos;
    }


    function  sendNotification($registration_ids, $message) 
    {

        $registrationIds = array($registration_ids);
        $msg = array(
            'message' => $message,
            'title' => 'notification center',
            'vibrate' => 1,
            'sound' => 1
        );

        $fields = array(
            'registration_ids' => $registrationIds,
            'data' => $msg
        );

        $fields = json_encode($fields);
        $arrContextOptions=array(
            "http" => array(
                "method" => "POST",
                "header" =>
                "Authorization: key = ".env('APP_KEY_PUSH'). "\r\n" .
                "Content-Type: application/json". "\r\n",
                "content" => $fields,
            ),
            "ssl"=>array(
                "allow_self_signed"=>true,
                "verify_peer"=>false,
            ),
        );

        $arrContextOptions = stream_context_create($arrContextOptions);
        $result = file_get_contents('https://android.googleapis.com/gcm/send', false, $arrContextOptions);

        return $result;

    }

   
}
