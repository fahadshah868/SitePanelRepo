<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Store extends Controller
{
    public function addStore(){
        return View('pages.store.addstore');
    }
}
