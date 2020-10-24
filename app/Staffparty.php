<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staffparty extends Model
{
    public function location(){
        return $this->belongsTo('App\Location')->withDefault();

    }

    public function daypart(){
        return $this->hasMany('App\Daypart');
    }
}
