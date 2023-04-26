<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::getActive();

        return view('categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        if ($category->status === Category::STATUS_HIDE) {
            abort(404);
        }

        $category->load(['activeProducts', 'translations']);

        return view('categories.show', compact('category'));
    }

}
