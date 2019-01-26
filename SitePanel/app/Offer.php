<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table = "offers";
    protected $primaryKey = "id";

    public function store(){
        return $this->belongsTo('App\Store');
    }
    public function category(){
        return $this->belongsTo('App\Category');
    }
    public function offer_type(){
        return $this->belongsTo('App\OfferType');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
}