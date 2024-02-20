<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    public function products() {
        return view('product.product', [
            'products' => Product::filter(request(['search', 'category']))
                                    ->get(),
            'categories' => Category::all(),
        ]);
    }

    public function productCreate() {
        return view('product.product-createform', [
            'categories' => Category::orderby('id')->get(),
        ]);
    }

    public function productStore() {
        // try {
            $formData = request()->validate([
                'title' => 'required',
                'description'  => 'required',
                'category_id' => 'required | exists:categories,id',
                'price' => 'required | numeric',
                'image' => 'required | image ',
            ]);
        // } 
        //     catch (ValidationException $e) {
        //     return $e->validator->errors();
        // }
    

        $formData['image'] = request()->file('image')->store('images');

        Product::create($formData);

        return redirect('/admin/products')->with('success', 'Product Created Successfully');
    }

    public function productEdit(Product $product) {
        return view('product.product-editform', [
            'product' => $product,
            'categories' => Category::orderby('id')->get(),
        ]);
    }

    public function productUpdate(Product $product) {
        // try {
            $formData = request()->validate([
                'title'       => 'required',
                'description' => 'required',
                'category_id' => 'required|exists:categories,id',
                'price' => 'required | numeric',
                'image' => ' image | mimes:jpeg,png,jpg,gif,svg | max:2048',
            ]);
        // } catch (\Throwable $e) {
        //     return $e->validator->errors();
        // }
        

        // $formData['user_id'] = auth()->id();
        $formData['image'] = request()->file('image') ? request()->file('image')->store('images') : $product->image;

        $product->update($formData);

        return redirect('/admin/products')->with('success', 'Product Successfully Updated');
        
    }

    public function productDestroy(Product $product) {
        $product->delete();

        return back()->with('success', 'Product Successfully Deleted');
    }
}
