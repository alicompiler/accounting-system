<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller {

    public function index() {
        $categories = Category::all();
        return view("category.index", ["categories" => $categories]);
    }

    public function edit($id) {
        $category = Category::findOrFail($id);
        return view("category.edit", ["category" => $category]);
    }

    public function store(Request $request) {
        $category = new Category($request->all());
        $category->active = true;
        $category->save();
        return redirect(route("categories"));
    }

    public function update(Request $request) {
        $category = Category::findOrFail($request->get("id"));
        $category->fill($request->all());
        $category->save();
        return redirect(route("categories"));
    }

    public function active(Request $request) {
        $category = Category::findOrFail($request->get("id"));
        $category->active = true;
        $category->save();
        return redirect(route("categories"));
    }

    public function disable(Request $request) {
        $category = Category::findOrFail($request->get("id"));
        $category->active = false;
        $category->save();
        return redirect(route("categories"));
    }
}
