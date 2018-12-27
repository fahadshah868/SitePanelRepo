<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfferType extends Model
{
    public function offer(){
        return $this->hasMany('App\Offer');
    }
}
