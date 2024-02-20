<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Termwind\Components\Dd;
use Illuminate\Http\Request;
use Illuminate\Support\Number;

class HomeController extends Controller
{
    public function home(Product $product, User $user) {
        $totalSale = Order::sum('total_amount');
        $formattedTotalSale = number_format($totalSale, 2, '.', ',');

        // pie-chart
        $categories = Category::withCount('products')->get();
        $data = [            
            'labels' => $categories->pluck('name')->toArray(),
            'data' =>  $categories->pluck('products_count')->toArray(),
        ];

        // bar-chart
        $topFiveSpendingUsers = User::withSum('orders', 'total_amount')
            ->orderByDesc('orders_sum_total_amount')
            ->take(5)
            ->get(['name', 'orders_sum_total_amount']); 

        $bar = [            
            'labels' => $topFiveSpendingUsers->pluck('name')->map(function ($name) {
                return Str::limit($name, 10);
            })->toArray(),            
            'data' =>  $topFiveSpendingUsers->pluck('orders_sum_total_amount')->toArray(),
        ];

        return view('home.home', [
            'products'  => Product::latest()->get(),
            'users'     => User::latest()->get(),
            'orders'    => Order::latest()->get(),
            'totalSale' => $formattedTotalSale, 
            'data'      => $data,
            'bar'      => $bar,
            'topFiveSpendingUsers'  => $topFiveSpendingUsers
        ]);
    }
}

