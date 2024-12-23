<?php

namespace App\Services\Product;

use App\Models\Product;

class ProductStoreService
{
    public function __invoke($formData)
    {
        $formData['image'] = request()->file('image')->store('images');

        Product::create($formData);   
    }
}