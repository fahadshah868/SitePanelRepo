<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";
    protected $primaryKey = "id";
    public $timestamps = true;

    //has many
    public function offers(){
        return $this->hasMany('App\Offer');
    }
    public function storecategories(){
        return $this->hasMany('App\StoreCategory');
    }
    //belongs to
    public function user(){
        return $this->belongsTo('App\User');
    }
}