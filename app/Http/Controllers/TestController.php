<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index( float $number_1 ,  float $number_2) : float
    {
        if($number_1 <= 0 || $number_2 <= 0){
            return '0.000';
        }else{
            return number_format($number_1/$number_2 , 3);
        }
    }
}
