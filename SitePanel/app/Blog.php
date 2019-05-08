<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = "blogs";
    protected $primaryKey = "id";
    public $timestamps = true;

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
    public function blogcategory(){
        return $this->belongsTo('App\BlogCategory', 'blog_category_id');
    }
    public function comments(){
        return $this->hasMany('App\BlogComment');
    }
}
