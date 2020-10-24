<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    public function task(){
        return $this->hasMany('App\Task');
    }

    public function roomactivity(){
        return $this->hasMany('App\Roomactivity');
    }

    public function location(){
        return $this->belongsTo('App\Location');
    }

    public function daypart_activity(){
        return $this->hasMany('App\Daypart_activity');
    }

    public function chosentransport(){
        return $this->hasMany('App\Chosentransport');
    }
}
