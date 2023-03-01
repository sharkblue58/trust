<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\LoginNotification;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
      public function redirect(){
        return Socialite::driver('facebook')->redirect();
      }
      public function callback(){
        try{
          $facebookUser = Socialite::with('facebook')->stateless()->user();
          //return response()->json($facebookUser);
          $user = User::where('email', $facebookUser->emil)->first();
           if ($user!=null) {
              $user1=Auth::user();
              $user1->tokens()->delete();
              $user1->notify(new LoginNotification());
              $success['token']=$user1->createToken('user',['user'])->plainTextToken;
              $success['msg']=$user->name;
              $success['success']=true;
              return response()->json($success,200);
  
          } else {
              return response()->json([
                  'msg'=>"need to register"
              ]);
           
          }  
      }catch (Exception $ex) {
          return response()->json(['status' => 'error', 'expcetion' => $ex->getMessage(), 'msg' => ' facebook failed'], 500);
      }
      }
}
