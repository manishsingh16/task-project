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

class UserController extends Controller
{
    public function register(Request $request){
        $this->validate($request, [
          'name' => 'required',
          'email' => 'required',
          
      ]);
      $request->all();
      
      $name = $request->name;
      $email = $request->email;
     
     $user = new User;
     
      $check = $user->where('email',$email)->exists();
      if($check)
    {
      echo "this customer already exists in database";
    }
    else
    {
        $uswr = new User;
        $user->email = $email;
        $user->name = $name;
        $result = $user->save();
      if(!$result)
      {
        echo "inserted";
        echo  "<br>";
        echo "$result";
      }
else 
{
echo "$result";
echo "ok";
}
      }

     }
      

     public function login(Request $request)
     {
        $validator = Validator($request->all(), [
               'email' => 'required',
               
           ]);
  
           if ($validator->fails()) {
  
               return response()->json([
                 'status' => false, 
                 'message' => $validator->messages()
                ], 400);
           } 
           $credentials = ['email' => $request->email];
           $users = User::where($credentials)->exists();
         
           if(!$users){
  
              return response()->json([
                'status'=>false,
                'message' => "We cant find email",
            ], 200);      
           }
           else
           {
               
            $request->session()->put('email',$request->email);
            if($request->session()->has('email'))
            echo $request->session()->get('email');
            return view('profile');
            
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
             
             if($quantity > $wallet){
                return ('/sorry  not enough amount');
            }
            $check = DB::table('users')->where('email', $email)->update([
                'wallet'=> $wallet - $quantity
            ]);
            if($check){
                return (' You have bought '. $quantity .' cookies');
              
            }else{
                return view('Unable to purchase.');
            }
         
      
   }



    }
