<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Product extends Controller
{
    public function addProduct(){
        return view('pages.product.addproduct');
    }
}
