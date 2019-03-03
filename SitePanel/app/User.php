<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = "users";
    protected $primaryKey = "id";
    public $timestamps = true;

    public function network(){
        return $this->hasMany('App\Network');
    }
    public function store(){
        return $this->hasMany('App\Store');
    }
    public function category(){
        return $this->hasMany('App\Category');
    }
    public function offer(){
        return $this->hasMany('App\Offer');
    }
    public function carouseloffer(){
        return $this->hasMany('App\CarouselOffer');
    }
    public function storecategorygroup(){
        return $this->hasMany('App\StoreCategoryGroup');
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password', 'usertype', 'userstatus',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
