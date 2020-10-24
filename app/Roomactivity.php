<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roomactivity extends Model
{
    public function room(){
        return $this->belongsTo('App\Room');
    }

    public function activity(){
        return $this->belongsTo('App\Activity');
    }
}
