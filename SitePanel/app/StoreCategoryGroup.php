<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreCategoryGroup extends Model
{
    protected $table = "store_category_groups";
    protected $primaryKey = "id";

    public function store(){
        return $this->belongsTo('App\Store');
    }
    public function category(){
        return $this->belongsTo('App\Category');
    }
}
