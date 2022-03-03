<?php

namespace App\Http\Controllers\backend;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\About;

class AboutController extends Controller
{
   public function index(){
      $data = About::all();
    return view('backend.aboutus',['data'=>$data]);
}
public function storeData(Request $request){
   $validator = Validator::make($request->all(),[
       'email'=>'required',
        'contact'=>'required|numeric',
        'description'=>'required',
        'image'=>'required|image|mimes:jpeg,png,jpg',
   ]);
   if($validator->fails())
   {
       return response()->json([
           'status'=>400,
           'errors'=>$validator->messages(),
       ]);
   }
   else{
       $post = new About;
       $post->email = $request->input('email');
       $post->contact = $request->input('contact');
       $post->description = $request->input('description');
       if($request->hasfile('image'))
       {
       $file = $request->file('image');
       $extension= $file->getClientOriginalExtension();
       $filename= time().'.'.$extension;
       $file->move('about/',$filename);
       $post->image = $filename;
       }
       $post->save();
       return response()->json([
           'status'=>200,
           'message'=>'Data added successfully',
       ]);
   }
}

public function editData(Home $data,$id){
   return view('backend.edit')->with('data', About::find($id));
}
public function updateData(Request $request,$id){
   $input= About::find($id);
   $input->email = $request->input('email');
   $input->contact = $request->input('contact');
   $input->description = $request->input('description');
   if($request->hasfile('image'))
   {
       $destination = 'about/'.$input->image;
       if(File::exists($destination))
       {
        File::delete($destination);
       }
    $file=$request->file('image');
    $extension = $file->getClientOriginalExtension();
    $filename = time().'.'.$extension;
    $file->move('about/', $filename);
    $input->image=$filename;        
   }
   $input->update();
   return redirect('aboutus');
  }
              
}
