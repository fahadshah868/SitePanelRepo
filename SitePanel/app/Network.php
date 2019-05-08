<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Network extends Model
{
    protected $table = "networks";
    protected $primaryKey = "id";
    public $timestamps = true;

    //has many
    public function stores(){
        return $this->hasMany('app\Store');
    }
    //belongs to
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}
