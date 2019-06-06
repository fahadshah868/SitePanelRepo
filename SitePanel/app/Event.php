<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = "events";
    protected $primaryKey = "id";
    public $timestamps = true;

    // has many 
    public function eventoffers(){
        return $this->hasMany('App\EventOffer');
    }
    //belongs to
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}
