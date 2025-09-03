<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;




class CategoryController extends Controller
{
    // Show category page
    public function category()
    {
         $categories = Category::all(); // fetch all categories
    return view('admin.category.category', compact('categories'));
       
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
    $imagePath = $request->file('image')->store('categories', 'public');

    // save data in DB
    $category = new Category();
    $category->name = $request->name;
    $category->slug = $request->slug;
    $category->description = $request->description;
    $category->image = $imagePath; // ✅ use $imagePath not $imageName
    $category->save();

    return redirect()->route('category')->with('success', 'Category created successfully!');
}


    // Show edit form
public function edit($id)
{
    $category = Category::findOrFail($id);
    // dd($category->image);
    return view('admin.category.edit', compact('category'));
}

// Handle update
public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:categories,slug,' . $id,
        'description' => 'required|string',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
    ]);

    $category = Category::findOrFail($id);
    $category->name = $request->name;
    $category->slug = $request->slug;
    $category->description = $request->description;

    // Update image if new uploaded
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('categories', 'public');
        $category->image = $imagePath;
    }

    $category->save();

    return redirect()->route('category')->with('success', 'Category updated successfully!');
}
public function destroy($id)
{
    $category = Category::findOrFail($id);

    // delete image if exists
   if ($category->image && file_exists(public_path('uploads/categories/'.$category->image))) {
        unlink(public_path('uploads/categories/'.$category->image));
    }

    // delete category
    $category->delete();

    return redirect()->route('category')->with('success', 'Category deleted successfully!');
}
}
