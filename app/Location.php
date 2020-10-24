<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    public function staffparty(){
        return $this->hasMany('App\Staffparty');
    }

    public function activity(){
        return $this->hasMany('App\Activity');
    }
}
