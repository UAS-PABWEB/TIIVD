<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theory extends Model
{
    protected $table = "theories";
    
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function clasroom(){
        return $this->belongsTo('App\Classroom');
    }
}
