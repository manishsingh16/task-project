<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request){
        $this->validate($request, [
          'name' => 'required',
          'email' => 'required',
          'password'=> 'required',
          
      ]);
      $name = $request->name;
      $email = $request->email; 
      $password = $request->password;
      $hashPassword = Hash::make($password);
      $user = new User;
      $check = $user->where('email',$email)->exists();
      if($check)
    {
      return "User already exists";
    }
    {
        $user = new User;
        $user->email = $email;
        $user->name = $name;
        $user->password = $hashPassword;
        $result = $user->save();
    }
        return "User register successfully ";
    
    }

     public function login(Request $request)
     {
        $validator = Validator($request->all(), [
               'email' => 'required',
               'password'=>'required',
               
           ]);
  
           if ($validator->fails()) {
  
               return response()->json([
                 'status' => false, 
                 'message' => $validator->messages()
                ], 400);
           } 
           $password  = $request->password;
           $credentials = ['email' => $request->email];
           $users = User::where($credentials)->first();
           if(!$users)
           {
            return "Please Register  User Don't exists.";
           }
           $fetchedPass = $users->password;
           $email = $users->email;
           $name = $users->name;
           $passCheck = Hash::check($password, $fetchedPass);
         
           if(!$passCheck){
  
           return "Incorrect user Email or password.";
           }

           else
           {
               
             $request->session()->put('email', $email);
            return view('profile', ['email'=>$email, 'name'=>$name]);
            
           }
  
          }
  


          public function storeSessionData(Request $request) 
          {
            $validator = Validator($request->all(), [
                'quantity' => 'required',
                
            ]);
   
            if ($validator->fails()) {
   
                return response()->json([
                  'status' => false, 
                  'message' => $validator->messages()
                 ], 400);
            } 
             $email  =  $request->session()->get('email');
             $quantity = $request->quantity;
             $user = new User();
             $userFetched = $user->where('email', $email)->first(); 
             $wallet = $userFetched->wallet;
             
             if($quantity > $wallet)
             {
                return ('Sorry  not enough amount your current wallet amount '.$wallet.'');
             }
            $check = DB::table('users')->where('email', $email)->update([
                'wallet'=> $wallet - $quantity
            ]);
            if($check)
            {
              $userFetched = $user->where('email', $email)->first();
              $wallet = $userFetched->wallet;
               
                return('Success, you have bought ' . $quantity . ' cookies!');
              
           }
      
   }



    }
