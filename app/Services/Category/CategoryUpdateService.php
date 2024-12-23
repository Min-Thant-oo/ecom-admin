<?php

namespace App\Services\Category;

use App\Models\Product;

class CategoryUpdateService
{
    public function __invoke($formData, $category)
    {   
        $category->update($formData);
    }

}