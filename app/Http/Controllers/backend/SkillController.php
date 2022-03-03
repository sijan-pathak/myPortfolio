<?php

namespace App\Http\Controllers\backend;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ValidateRequest;

class SkillController extends Controller
{
    public function index(){
        $data = DB::table('skills')->get();
        return view('backend.skills',compact('data'));
    }   
    public function show(){
        return view('backend.skill-add');
    }
    public function skillStore(ValidateRequest $request){
     DB::table('skills')->insert($request->validated());
     return back()->with('success','Thank you!! You Successfully added your skill');
    }
}
