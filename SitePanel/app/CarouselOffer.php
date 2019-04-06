<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarouselOffer extends Model
{
    protected $table = "carousel_offers";
    protected $primaryKey = "id";
    public $timestamps = true;

    public function store(){
        return $this->belongsTo('App\Store');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
}
