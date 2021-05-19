<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;

class AuthController extends Controller
{
    protected $auth;
    public function __construct(AuthService $auth)
    {
        $this->auth = $auth;    
    }

    public function loginView()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        try {

            $login = $this->auth->login($request);

        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }

        return ($login) ? redirect()->route('home') : redirect()->back()->with('error', 'Login gagal');
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('login');
    }
    
}
