<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Services\Product\ProductStoreService;
use App\Services\Product\ProductUpdateService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    public function index() 
    {
        return view('product.index', [
            'products' => Product::with('category')
                    ->withCount('users')
                    ->filter(request(['search', 'category']))
                    ->latest()
                    // ->get(),
                    ->paginate(10)
                    ->withQueryString(),
            'categories' => Category::all(),
        ]);
    }

    public function create() 
    {
        return view('product.create', [
            'categories' => Category::orderby('id')->get(),
        ]);
    }

    public function store(ProductRequest $request, ProductStoreService $productStoreService) 
    {
        $productStoreService($request->validated());
        return to_route('products.index')->with('success', 'Product Created Successfully');
    }

    public function edit(Product $product) {
        return view('product.edit', [
            'product' => $product,
            'categories' => Category::orderby('id')->get(),
        ]);
    }

    public function update(Product $product, ProductRequest $request, ProductUpdateService $productUpdateService) 
    {
        $productUpdateService($request->validated(), $product);
        return to_route('products.index')->with('success', 'Product Successfully Updated');
    }

    public function destroy(Product $product) 
    {
        $product->delete();
        return back()->with('success', 'Product Successfully Deleted');
    }
}
