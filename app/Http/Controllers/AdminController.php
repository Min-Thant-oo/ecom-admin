<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function admin_info() {
        return view('admininfo.info', [
            'user'  => auth()->user(),
        ]);
    }

    public function admin_info_update(User $user) {
        $formData = request()->validate([
            'name'   => 'required',
            'email'  => 'required|unique:users,email,' . $user->id,
            'phone'  =>  'required|numeric|unique:users,phone,' . $user->id
        ]);

        $user->update($formData);
        

        return redirect('/admin/info')->with('success', 'Admin Information has been updated successfully');
    }
}
