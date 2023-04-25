<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\App;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(1);

        return view('admin.categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(CreateCategoryRequest $request)
    {
        $data = $request->validated();

        $category = Category::create([$data??['status']]);

        foreach($data['langs'] as $locale => $name)
            $category->translations()->create([
                'locale' => $locale,
                'name' => $name['name']
            ]);

        return redirect()->route('admin.categories.index');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(CreateCategoryRequest $request, Category $category)
    {
        $data = $request->validated();

        $category->update([$data??['status']]);

        foreach($data['langs'] as $locale => $name){
            $category->translations()->whereLocale($locale)->update([
                'name' => $name['name']
            ]);
        }

        return redirect()->route('admin.categories.show', compact('category'));
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index');
    }

}
