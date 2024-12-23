<?php

namespace App\Services\Product;

class ProductUpdateService
{
    public function __invoke($formData, $product)
    {
        $formData['image'] = request()->file('image') ? request()->file('image')->store('images') : $product->image;

        $product->update($formData);
    }
}