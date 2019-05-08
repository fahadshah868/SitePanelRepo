<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $table = "stores";
    protected $primaryKey = "id";
    public $timestamps = true;

    //has many
    public function offers(){
        return $this->hasMany('App\Offer');
    }
    public function storecategories(){
        return $this->hasMany('App\StoreCategory');
    }
    public function carouseloffers(){
        return $this->hasMany('App\CarouselOffer');
    }
    //belongs to
    public function network(){
        return $this->belongsTo('App\Network','network_id');
    }
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}
