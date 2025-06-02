<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');

    }
    public function handeLogin(AuthRequest $request){
$credential = $request->only(['email','password']);
if(Auth::attempt($credential)){
     return redirect()->route('dashboard');
    }else{
       return redirect()->back()->with('error_msg','Parametre de connexion non reconnu');
    }
}

public function logout()
{
    Auth::logout();
    return redirect()->route('login');
}
}
