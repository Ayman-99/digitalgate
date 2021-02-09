<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function __construct()
    {
        //
    }

    public function customerIndex()
    {
        return view('profile');
    }
}
