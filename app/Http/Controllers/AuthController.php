<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\User;




class AuthController extends Controller
{
    
    public function register(Request $request){
        $request->validate([
            'name'=>'required|string',
            'email'=>'required|string|unique:users',
            'password'=>'required|string'

        ]);

        $user =  new User([
            'name' => $request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);

        $user->save();
        return response()->json(['message'=>'User successfully registered'],200);
        //return response()->json(['message'=>'Email already taken'],422);
    }
    public function login(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required|string',
        ]);

        $credentials=request(['email','password']);

        if(!Auth::attempt($credentials)){
            return response()->json(['message'=>'Invalid credentials'],401);
        }
        
        $user = $request->user();
        $tokenResult = $user->createToken('Access Token');
        $token = $tokenResult->accessToken;
//$token->expires_at =Carbon::now()->addDays(env('PERSONAL_ACCESS_TOKEN_EXPIRY__DAYS'));
//dd($token);
$token->save();
        return response()->json(['message'=>'User successfully Login',
      
        'access_token'=>$tokenResult->accessToken,
    

        ] ,200);
      
//
    }


    public function logout(User $user){

        $user->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }
}


