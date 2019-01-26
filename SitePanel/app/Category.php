<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";
    protected $primaryKey = "id";

    //has many
    public function offer(){
        return $this->hasMany('App\Offer');
    }
    public function storecategorygroup(){
        return $this->hasMany('App\StoreCategoryGroup');
    }
    //belongs to
    public function form_user(){
        return $this->belongsTo('App\User');
    }
    public function image_user(){
        return $this->belongsTo('App\User');
    }
}