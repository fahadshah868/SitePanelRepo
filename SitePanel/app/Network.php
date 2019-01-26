<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Network extends Model
{
    protected $table = "networks";
    protected $primaryKey = "id";

    //has many
    public function store(){
        return $this->hasMany('app\Store');
    }
    //belongs to
    public function user(){
        return $this->belongsTo('App\User');
    }
}
