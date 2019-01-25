<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfferType extends Model
{
    protected $table = "offer_types";
    protected $primaryKey = "id";

    public function offer(){
        return $this->hasMany('App\Offer');
    }
}
