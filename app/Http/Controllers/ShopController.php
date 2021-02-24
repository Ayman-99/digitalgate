<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        return view('catalog');
    }

    public function category($category){
        return view('category');
    }
}
