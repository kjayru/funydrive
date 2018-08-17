<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    public function poblacions(){
        return $this->hasMany(App\Poblacion::class,'provinciaid','provinciaid');
    }
    public function postalcodes(){
        return $this->hasMany(App\PostalCode::class,'provinciaid','provinciaid');
    }
}
