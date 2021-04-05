<?php


namespace App\Http\Controllers;

use App\Http\Classes\Recommend;

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

    function test()
    {
        $list = array();
        $rates = \App\Models\Rate::whereRaw('1=1')->with('user')->with('product')->get();
        foreach ($rates as $rate) {
            if(array_key_exists($rate->user->id, $list)){
                $list[$rate->user->name][$rate->product->name] = $rate->product->rate;
                continue;
            }
            $list[$rate->user->name][$rate->product->name] = $rate->product->rate;
        }
        $re = new Recommend();
        $result = $re->transformPreferences($list);
        return$re->matchItems($result, "product 69");
    }
}
