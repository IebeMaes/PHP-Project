<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function activity(){
        return $this->belongsTo('App\Activity');
    }

    public function registrationtask(){
        return $this->hasMany('App\Registrationtask');
    }
}
