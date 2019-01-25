<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";
    protected $primaryKey = "id";

    public function offer(){
        return $this->hasMany('App\Offer');
    }
    public function storecategorygroup(){
        return $this->hasMany('App\StoreCategoryGroup');
    }
}