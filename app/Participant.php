<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    public function registration(){
        return $this->hasMany('App\Registration');
    }

    public function registrationtask(){
        return $this->hasMany('App\Registrationtask');
    }
}
