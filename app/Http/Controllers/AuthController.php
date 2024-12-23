<?php

namespace App\Http\Controllers;

use App\Http\Requests\loginRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;


class AuthController extends Controller
{
    public function login() {
        return view('auth.login');
    }

    public function post_login(loginRequest $request) 
    {
        if (auth()->attempt($request->validated()) && auth()->user()->usertype !== 1) {
            return to_route('login')->with('success', 'Wrong Credentials!');
        } else {
            return to_route('home.index')->with('success', 'Welcome back');
        }
    }
        
    
    public function logout() {
        auth()->logout();

        return to_route('login')->with('success', 'Logout Successfully');
    }
}
