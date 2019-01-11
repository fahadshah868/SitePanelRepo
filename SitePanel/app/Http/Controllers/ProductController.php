<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;
use App\Category;
use App\OfferType;

class ProductController extends Controller
{
    public function addProduct(){
        $data['allstores'] = Store::all();
        $data['allcategories'] = Category::all();
        $data['alloffertypes'] = OfferType::all();
        return view('pages.product.addproduct',$data);
    }
    public function getAllProducts(){
        return view('pages.product.allproducts');
    }
}
