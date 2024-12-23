<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index(Product $product, User $user) {
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

        return view('home.index', [
            'products'              => Product::with('category')->latest()->take(7)->get(),
            'productCount'          => Product::count(),
            'userCount'             => User::count(),
            'orders'                => Order::with('user', 'products')->latest()->take(5)->get(),
            'orderCount'            => Order::count(),
            'totalSale'             => $formattedTotalSale, 
            'data'                  => $data,
            'bar'                   => $bar,
            'topFiveSpendingUsers'  => $topFiveSpendingUsers
        ]);
    }
}

