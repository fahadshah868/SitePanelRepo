<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarouselOffer extends Model
{
    protected $table = "carousel_offers";
    protected $primaryKey = "id";

    public function store(){
        return $this->belongsTo('App\Store');
    }
    public function offer_type(){
        return $this->belongsTo('App\OfferType');
    }
    public function form_user(){
        return $this->belongsTo('App\User');
    }
    public function image_user(){
        return $this->belongsTo('App\User');
    }
}
