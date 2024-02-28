<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;


class AuthController extends Controller
{
    public function login() {
        return view('auth.login');
    }

    public function post_login() {
        $formData = request()->validate([
            'email'    => 'required|exists:users,email',
            'password' => 'required',
            // 'usertype' => '1'
        ]);


        if (auth()->attempt($formData) && auth()->user()->usertype !== 1) {
            return redirect('/admin/login')->with('success', 'Wrong Cred');
        } else {
            return redirect('/admin/home')->with('success', 'Welcome back');
        }
    }
        
    
    public function logout() {
        auth()->logout();

        return redirect('/admin/login')->with('success', 'Logout Successfully');
    }
}
