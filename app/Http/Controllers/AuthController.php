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
        
        // if(auth()->attempt($formData)) {
        //     return redirect('/admin/home');
        // } else {
        //     return redirect('admin/login')->withErrors([
        //         'error' =>'shitty error'
        //     ]);
        // }

        // if(auth()->attempt($formData)) {
        //     if(auth()->user()->usertype == '1') {
        //         return redirect('/admin/home');
        //     } elseif (auth()->user()->usertype == '0') {
        //         return redirect('admin/login')->withErrors([
        //                     'error' =>'shitty error'
        //                 ]);
        //     }
            
        //     //     else {
        //     //     return redirect('admin/login')->withErrors([
        //     //         'error' =>'shitty error'
        //     //     ]);
        //     // } 
        // } 
        
        // else {
        //     return redirect('/admin/login')->withErrors([
        //         'error' => 'User Credentials Wrong'   
        //     ]);
        // }
    // }
    

    //     if (auth()->user()->usertype !== 1 && auth()->attempt($formData)) {
    //         return back()->with('message', 'Wrong Cred');
    //     } else {
    //         return redirect('/admin/home')->with('success', 'Welcome back');
    //     }
    // }
        // try {
        //     if (auth()->user()->usertype !== 1) {
        //         dd('hit');
        //         throw new \Exception('Invalid usertype');
        //     }
        
        //     return redirect('/admin/home')->with('success', 'Welcome back');
        // } catch (\Exception $e) {
        //     return back()->with('message', $e->getMessage());
        // }
    
        
        // try {
        //     $formData = request()->validate([
        //         'email'    => 'required|exists:users,email',
        //         'password' => 'required',
        //     ]);
        
        //     if (auth()->attempt($formData)) {
        //         dd(auth()->user);
        //         try {
        //             if (auth()->user()->usertype == '1') {
        //                 // dd(auth()->user);
        //                 return redirect('/admin/home')->with('success', 'Welcome back');
        //             } else {
        //                 throw new \Exception('User does not have admin privileges.');
        //             }
        //         } catch (\Exception $e) {
        //             throw new \Exception($e->getMessage());
        //         }
        //     } else {
        //         throw new \Exception('Invalid Credentials');
        //     }
        // } catch (\Exception $e) {
        //     return back()->with('message', $e->getMessage());
        // }
        
        
        
    
    // }

    // error return 'email' ka email input ye name. email input out mhr pya chin dr
    
    // return redirect('/admin/home')->with('success', 'Welcome back');

    
    
    public function logout() {
        auth()->logout();

        return redirect('/admin/login')->with('success', 'Logout Successfully');
    }
}
