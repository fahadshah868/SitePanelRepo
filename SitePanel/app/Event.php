<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = "events";
    protected $primaryKey = "id";
    public $timestamps = true;

    //belongs to
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}
