<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poblacion extends Model
{
    public function provincia(){
        return $this->belongsTo(App\Provincia::class,'provinciaid','provinciaid');
    }

    public function postalcodes(){
        return $this->hasMany(App\PostalCode::class,'poblacionid','poblacionid');
    }
}
