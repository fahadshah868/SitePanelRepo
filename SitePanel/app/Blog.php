<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = "blogs";
    protected $primaryKey = "id";
    public $timestamps = true;

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function blogcategory(){
        return $this->belongsTo('App\BlogCategory');
    }
    public function comments(){
        return $this->hasMany('App\BlogComment');
    }
}
