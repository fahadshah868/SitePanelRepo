<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table = "offers";
    protected $primaryKey = "id";
    public $timestamps = true;

    // has many
    public function eventoffers(){
        return $this->hasMany('App\EventOffer');
    }

    // belongs to
    public function store(){
        return $this->belongsTo('App\Store','store_id');
    }
    public function category(){
        return $this->belongsTo('App\Category','category_id');
    }
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}