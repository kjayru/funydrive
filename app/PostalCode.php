<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostalCode extends Model
{
    public function poblacion(){
        return $this->belongsTo(App\Poblacion::class,'poblacionid','poblacionid');
    }

    public function provincia(){
        return $this->belongsTo(App\Provincia::class,'provinciaid','provincia');
    }
}
