<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    //
    protected $table = "participants";

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function clasroom(){
        return $this->belongsTo('App\Classroom');
    }
}
