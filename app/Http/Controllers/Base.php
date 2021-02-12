<?php


namespace App\Http\Controllers;

class Base extends Controller
{
    function validation_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = strip_tags($data); //Remove html tags
        return $data;
    }
}
