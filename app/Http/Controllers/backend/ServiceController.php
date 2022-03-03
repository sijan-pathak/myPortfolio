<?php

namespace App\Http\Controllers\backend;
use Illuminate\Support\Facades\DB;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(){
        $data =DB::table('services')->get();
        return view('backend.service', compact('data'));
    }

    public function show(){
        return view('backend.service-add');
    }
    public function store(Request $request){
        $request->validate([
            'name'=>'required',
            'description'=>'required',
            'icon' => 'required',
            'is_active' =>'required'
        ]);
        DB::table('services')->insert([
            'name'=> $request->get('name'),
            'description' => $request->get('description'),
            'icon' => $request->get('icon'),
            'is_active'=> $request->get('is_active')
        ]);
        return back()->with('success','Thank You!! You Successfully added your services');
    }
}
