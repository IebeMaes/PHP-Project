<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Daypart extends Model
{
    public function staffparty(){
        return $this->belongsTo('App\Staffparty');
    }

    public function daypart_activity(){
        return $this->hasMany('App\Daypart_activity');
    }
}
