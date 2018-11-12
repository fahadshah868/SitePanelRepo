<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Coupon extends Controller
{
    public function addCoupon(){
        return view('pages.coupon.addcoupon');
    }
    public function getAllCoupons(){
        return view('pages.coupon.allcoupons');
    }
}
