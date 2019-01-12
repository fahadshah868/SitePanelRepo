<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    public function network(){
        return $this->belongsTo('App\Network');
    }
    public function offer(){
        return $this->hasMany('App\Offer');
    }
}
