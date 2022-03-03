<?php
namespace Illuminate\Filesystem\Filesystem;
namespace App\Http\Controllers\backend;
use Illuminate\Support\Facades\File;
use App\Home;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller{
     public function index(){
            $site_data = Home::all();
            return view('backend.home',['site_data'=>$site_data]);
    }    
    public function storeData(Request $request){
        $validator = Validator::make($request->all(),[
            'name'=>'required',
             'post'=>'required',
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
            $post = new Home;
            $post->name = $request->input('name');
            $post->post = $request->input('post');
            if($request->hasfile('image'))
            {
            $file = $request->file('image');
            $extension= $file->getClientOriginalExtension();
            $filename= time().'.'.$extension;
            $file->move('images/',$filename);
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
        return view('backend.edit')->with('data', Home::find($id));
    }
    public function updateData(Request $request,$id){
        $input= Home::find($id);
        $input->name = $request->input('name');
        $input->post = $request->input('post');
        if($request->hasfile('image'))
        {
            $destination = 'images/'.$input->image;
            if(File::exists($destination))
            {
             File::delete($destination);
            }
         $file=$request->file('image');
         $extension = $file->getClientOriginalExtension();
         $filename = time().'.'.$extension;
         $file->move('images/', $filename);
         $input->image=$filename;        
        }
        $input->update();
        return redirect('home');
       }
                   
 }
      
      

