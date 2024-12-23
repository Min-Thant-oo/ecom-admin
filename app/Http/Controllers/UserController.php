<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        return view('user.index', [
            'users' => User::with('orders')
                ->filter(request(['search']))
                ->latest()
                // ->get(),
                ->paginate(10)
                ->withQueryString(),
        ]);
    }
}
