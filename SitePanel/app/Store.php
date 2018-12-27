<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    public function offer(){
        return $this->hasMany('App\Offer');
    }
}
