<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function addCoupon(){
        return view('pages.coupon.addcoupon');
    }
    public function getAllCoupons(){
        return view('pages.coupon.allcoupons');
    }
}
