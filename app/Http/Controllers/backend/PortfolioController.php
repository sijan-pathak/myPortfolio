<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index(){
        return view('backend.portfolio');
    }
    public function show(){
        return view('backend.portfolio-add');
    }
    public function store(Request $request){
        $request->validate([
            'project_name'=>'required',
            'date'=> 'required',
            'image'=>'required'
        ]);
        

    }
}
