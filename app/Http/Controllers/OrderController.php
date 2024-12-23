<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderController extends Controller
{
    public function index() 
    {
        return view('order.index', [
            'orders' => Order::with('user', 'products')
                    ->latest()
                    ->filter(request(['search']))
                    // ->get(),
                    ->paginate(10)
                    ->withQueryString(),
        ]);
    }

    public function show(Order $order) 
    {
        return view('order.show', [
            'receipt'   =>  $order,
        ]);
    }
}
