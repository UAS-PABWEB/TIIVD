<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    //
    protected $table = "classroom";

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function participant(){
        return $this->hasMany('App\Participant');
    }

    public function theory(){
        return $this->hasMany('App\Theory');
    }
}
