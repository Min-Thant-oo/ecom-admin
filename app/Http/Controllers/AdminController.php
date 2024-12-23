<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use App\Services\User\UserUpdateService;

class AdminController extends Controller
{
    public function edit() 
    {
        return view('admininfo.edit', [
            'user'  => auth()->user(),
        ]);
    }

    public function update(UserRequest $request, UserUpdateService $userUpdateService) 
    {
        $user = Auth::user();
        $userUpdateService($request->validated(), $user);
        return to_route('info.edit')->with('success', 'Admin Information has been updated successfully');
    }
}
