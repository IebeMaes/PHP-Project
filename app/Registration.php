<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    public function daypart_activity(){
        return $this->belongsTo('App\Daypart_activity');
    }

    public function participant(){
        return $this->belongsTo('App\Participant');
    }

    public function chosentransport(){
        return $this->belongsTo('App\Chosentransport');
    }
}
