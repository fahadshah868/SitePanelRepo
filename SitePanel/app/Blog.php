<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = "blogs";
    protected $primaryKey = "id";
    public $timestamps = true;

    public function form_user(){
        return $this->belongsTo('App\User');
    }
    public function image_user(){
        return $this->belongsTo('App\User');
    }
}
