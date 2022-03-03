<?php

namespace App\Http\Controllers\backend;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Login;
use session;
class LoginController extends Controller
{
    public function index(){
        return view('backend.login');
    }
    public function register(){
        return view('backend.register');
    }
    public function auth_login(Request $request){
        $validated=$request->validate([
            'email'=> 'required|email',
            'password' => 'required',
        ],
      [
          'email.required' => "email is required",
          'password.required' => "password is required",
              ]);
       $login = Login::where('email',$request->email)->all(); 
       if($login){
           if($request->password == $login->password){
            $request->session()->put("loggedin",$login);
            
              return redirect()->route('backend.dashboard');
           }else{
               
                return redirect('backend.login');
           }
           }else{
               echo "user not found";
           }
          }
          public function dashboard(){
            return view('backend.dashboard');
        }
        public function logout(){
            if(session()->has('loggedin')){
              session()->forget('loggedin',null);
            }
            return redirect('login');
        }
    public function registerUser(Request $request){
        $request->validate([
            'name'=>"required",
            'email'=>'required|email|unique:Login',
            'password'=>'required|min:5|max:12',
            're'
        ]);
        $register = new Login();
    }

}