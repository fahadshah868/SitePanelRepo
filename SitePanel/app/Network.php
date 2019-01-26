<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Network extends Model
{
    protected $table = "networks";
    protected $primaryKey = "id";

    public function store(){
        return $this->hasMany('app\Store');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
}
