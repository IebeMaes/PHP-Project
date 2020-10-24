<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chosentransport extends Model
{
    public function activity(){
        return $this->belongsTo('App\Activity');
    }

    public function registration(){
        return $this->hasMany('App\Registration');
    }

    public function transportoption(){
        return $this->belongsTo('App\Transportoption');
    }

    public function registrationtask(){
        return $this->hasMany('App\Registrationtask');
    }
}
