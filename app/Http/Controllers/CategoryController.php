<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    private function validateCategory(Request $request) {
        return $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000'
        ]);
    }

    function index() {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    function show(Category $category) {
        return view('categories.show', compact('category'));
    }

    function create() {
        $category = new Category();
        return view('categories.create', compact('category'));
    }

    function store(Request $request) {
        Category::create($this->validateCategory($request));
        return redirect()->route('categories.index');
    }

    function edit(Category $category) {
        return view('categories.edit', compact('category'));
    }

    function update(Request $request, Category $category) {
        $category->update($this->validateCategory($request));
        return redirect()->route('categories.show', $category);
    }

    function destroy(Category $category) {
        $category->delete();
        return redirect()->route('categories.index');
    }
}
