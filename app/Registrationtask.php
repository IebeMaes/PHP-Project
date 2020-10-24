<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registrationtask extends Model
{
    public function task(){
        return $this->belongsTo('App\Task');
    }

    public function chosentransport(){
        return $this->belongsTo('App\Chosentransport');
    }

    public function user(){
        return $this->belongsTo('App\Participant');
    }
}
