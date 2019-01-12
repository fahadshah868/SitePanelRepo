<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Network extends Model
{
    public function store(){
        return $this->hasMany('app\Store');
    }
}
