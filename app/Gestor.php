<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gestor extends Model
{
    public static function conexion(){
        $con = mysqli_connect("35.195.132.92", "wavydrive", "*WavyDrive2018*", "funydrive");

        if (!$enlace) {
            echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
            echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
            echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
            exit;
        }

        echo "Éxito: Se realizó una conexión apropiada a MySQL! La base de datos mi_bd es genial." . PHP_EOL;
        echo "Información del host: " . mysqli_get_host_info($enlace) . PHP_EOL;

        //mysqli_close($enlace);
    }
}
