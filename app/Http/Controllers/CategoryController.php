<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class CategoryController extends Controller
{
    public function category()
    {
        return view('category.category', [
            'categories'    =>  Category::orderBy('id')
                ->filter(request(['search']))
                ->withCount('products')
                ->get(),
        ]);
    }

    public function categoryCreate()
    {
        return view('category.category-createform');
    }

    public function categoryStore()
    {
        $formData = request()->validate([
            'name'  => 'required | unique:categories,name',
            'slug'  => 'required | unique:categories,slug'
        ]);

        Category::create($formData);
        return redirect('/admin/categories')->with('success', 'Category Created Successfully');
    }

    public function categoryEdit(Category $category)
    {
        return view('category.category-editform', [
            'category'  => $category
        ]);
    }

    public function categoryUpdate(Category $category)
    {
        $formData = request()->validate([
            'name' => 'required | unique:categories,name,' . $category->id,
            'slug' => 'required | unique:categories,slug,' . $category->id
        ]);

        $category->update($formData);

        return redirect('/admin/categories')->with('success', 'Category Updated Successfully');
    }

    public function categoryDestory(Category $category)
    {
        $category->delete();

        return back()->with('success', 'Category Deleted Successfully');
    }
}
