<?php


namespace App\Http\Controllers;

use App\Http\Classes\Recommend;
use Illuminate\Support\Facades\Auth;

class Base extends Controller
{
    function validation_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = strip_tags($data); //Remove html tags
        return $data;
    }

    public function getArray($products)
    {
        $array1 = array();
        foreach ($products as $product) {
            if ($product->category->visible === 1) {
                array_push($array1, $product);
            }
        }
        return $array1;
    }
}
