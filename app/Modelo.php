<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    public function makeyear(){
        return $this->BelongsTo('App\MakeYear');
    }
}
