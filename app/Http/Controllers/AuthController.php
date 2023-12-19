<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //

    public function register(RegisterRequest $request){

         // Validation el register

         $data = $request->validate();

    }

    public function login(Request $request){

    }
    public function logout(Request $request){
        
    }
}
