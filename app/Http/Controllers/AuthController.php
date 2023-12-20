<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    //

    public function register(RegisterRequest $request){

         // Validation el register

         $data = $request->validate();

         // Create the user

         $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
         ]);

         // Return a response

         return [
            'token' => $user-> createToken('token')->plainTextToken,
            'user' => $user
         ];

    }

    public function login(LoginRequest $request){
      
      $data = $request->validate();

      // Revisa el password

      if(!Auth::attempt($data)){
         return response([
            'errors' => ['El email o el password son incorrectos']
         ], 422);
      }
    }
    public function logout(Request $request){
        
    }
}
