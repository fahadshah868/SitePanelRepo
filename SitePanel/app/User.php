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

    public function networks(){
        return $this->hasMany('App\Network');
    }
    public function stores(){
        return $this->hasMany('App\Store');
    }
    public function blogs(){
        return $this->hasMany('App\Blog');
    }
    public function categories(){
        return $this->hasMany('App\Category');
    }
    public function offers(){
        return $this->hasMany('App\Offer');
    }
    public function carouseloffers(){
        return $this->hasMany('App\CarouselOffer');
    }
    public function storecategories(){
        return $this->hasMany('App\StoreCategory');
    }
    public function blogcategories(){
        return $this->hasMany('App\BlogCategory');
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password', 'role', 'status',
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
