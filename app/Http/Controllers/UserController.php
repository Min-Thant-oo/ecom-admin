<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function user() {
        return view('user.user', [
            'users' => User::filter(request(['search']))->get(),
            // 'users' => User::withCount('orders')->orderByDesc('orders_count')->filter(request(['search']))->get(),

        ]);
    }
}
