<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
public function index(){
    return view('frontend.index');
}
public function portfolioDetails(){
    return view('frontend.portfolio-details');
}
}