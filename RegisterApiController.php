<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//add model
use App\Models\User;
use App\Models\Medias;
//for password encrypt add this
use Illuminate\Support\Facades\Hash;
//for login add this
use Illuminate\Support\Facades\Auth;
use DB;

class RegisterApiController extends Controller
{
    function register(Request $request){
        
        $request->validate([
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'email' => 'required|string|email',
            'password' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
        ]);
        
          $user = User::create([
            'f_name' => $request->firstName,
            'l_name' => $request->lastName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_no' => $request->phone,
           'address' => $request->address,
        

        ]);
        
        if($user){
            return response()->json("inserted");
            
        }else{
            return response()->json("not Insert");
        }
        
        
    }
    
    function login(Request $request){
        
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
             $id = Auth::id();
             $data = User::find($id);
             return $data;
        }else{

        return response()->json("Invalid Email Or Password");
    }
    }
    
    
    
    
   
    
    
    function mediaview(){
        
          $media = DB::table('medias')
            ->join('users', 'users.id', '=', 'medias.user_id')
            ->join('screens', 'screens.id', '=', 'medias.location')
            ->join('user_screens', 'user_screens.id', '=', 'medias.remarks')
            ->select('users.f_name','screens.screen_location','user_screens.name', 'medias.*')
            ->get();
        return $media;
    }
    
    
    
    
    
}
