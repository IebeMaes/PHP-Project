<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public function roomactivity(){
        return $this->hasMany('App\Roomactivity');
    }
}
