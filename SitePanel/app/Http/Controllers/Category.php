<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Category extends Controller
{
    public function addCategory(){
        return view('pages.category.addcategory');
    }
}
