<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transportoption extends Model
{
    public function chosentransport(){
        return $this->hasMany('App\Chosentransport');
    }
}
