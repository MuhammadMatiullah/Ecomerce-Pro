<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

class CategoryController extends Controller
{
    // Show category page
    public function category()
    {
        return view('admin.category.category'); 
       
    }
    public function create()
{
    return view('admin.category.create'); 
}
// Handle form submission
    public function store(Request $request)
    {
        // validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // handle image upload
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('uploads/categories'), $imageName);

        // save data in DB
        $category = new Category();
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->description = $request->description;
        $category->image = $imageName;
        $category->save();

        return redirect()->route('category')->with('success', 'Category created successfully!');
    }
}
