<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const ADMIN = 1;
    const ASSOCIATED = 2;
    const CLIENT = 3;

}
