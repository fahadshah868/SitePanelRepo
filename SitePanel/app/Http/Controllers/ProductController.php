<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function addProduct(){
        return view('pages.product.addproduct');
    }
    public function getAllProducts(){
        return view('pages.product.allproducts');
    }
}
