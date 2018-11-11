<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Store extends Controller
{
    public function addStore(){
        return View('pages.store.addstore');
    }
    public function viewAllStores(){
        return view('pages.store.allstores');
    }
}
