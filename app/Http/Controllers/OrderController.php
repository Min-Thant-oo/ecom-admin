<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderController extends Controller
{
    public function order() {
        return view('order.order', [
            'orders' => Order::filter(request(['search']))
                                ->get(),
        ]);
    }

    public function viewReceipt($id) {
        return view('order.order-view-receipt', [
            'receipt'   =>  Order::find($id),
        ]);
    }

    
}
