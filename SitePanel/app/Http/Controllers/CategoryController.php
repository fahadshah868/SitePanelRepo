<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function addCategory(){
        return view('pages.category.addcategory');
    }
    public function getAllCategories(){
        return view('pages.category.allcategories');
    }
}
