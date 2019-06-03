<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventOffer extends Model
{
    protected $table = "event_offers";
    protected $primaryKey = "id";
    public $timestamps = true;

    //belongs to
    public function offer(){
        return $this->belongsTo('App\Offer','offer_id');
    }
    public function event(){
        return $this->belongsTo('App\Event','event_id');
    }
}
