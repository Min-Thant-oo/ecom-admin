<?php

namespace App\Services\Category;

use App\Models\Product;
use App\Models\Category;

class CategoryStoreService
{
    public function __invoke($formData)
    {
        Category::create($formData);
    }

}