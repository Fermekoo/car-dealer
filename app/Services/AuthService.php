<?php 
namespace App\Services;

use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function login($request)
    {
        Auth::attempt(['email' => $request->email, 'password' => $request->password]);

        if(Auth::check()) {
            return true;
        }

        throw new \Exception('Email atau password salah');  
    }
}