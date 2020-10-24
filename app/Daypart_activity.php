<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Daypart_activity extends Model
{
    public function daypart(){
        return $this->belongsTo('App\Daypart');
    }

    public function registration(){
        return $this->hasMany('App\Registration');
    }

    public function activity(){
        return $this->belongsTo('App\Activity');
    }
}
