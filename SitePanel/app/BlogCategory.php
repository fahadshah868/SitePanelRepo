<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    protected $table = "blog_categories";
    protected $primaryKey = "id";
    public $timestamps = true;

    public function user(){
        return $this->belongsTo('App\User');
    }
}
