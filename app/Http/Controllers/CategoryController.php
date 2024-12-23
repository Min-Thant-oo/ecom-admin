<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\Category\CategoryStoreService;
use App\Services\Category\CategoryUpdateService;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class CategoryController extends Controller
{
    public function index()
    {
        return view('category.index', [
            'categories'    =>  Category::latest()
                ->filter(request(['search']))
                // ->get(),
                ->paginate(10)
                ->withQueryString(),
        ]);
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(CategoryRequest $request, CategoryStoreService $categoryStoreService)
    {
        $categoryStoreService($request->validated());
        return to_route('categories.index')->with('success', 'Category Created Successfully');
    }

    public function edit(Category $category)
    {
        return view('category.edit', [
            'category'  => $category
        ]);
    }

    public function update(Category $category, CategoryRequest $request, CategoryUpdateService $categoryUpdateService)
    {
        $categoryUpdateService($request->validated(), $category);
        return to_route('categories.index')->with('success', 'Category Updated Successfully');
    }

    public function destory(Category $category)
    {
        $category->delete();

        return back()->with('success', 'Category Deleted Successfully');
    }
}
