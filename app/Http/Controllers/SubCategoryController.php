<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
class SubCategoryController extends Controller
{
    public function index()
    {
        $subcategories = SubCategory::with('category')->get();
    return view('admin.subcategory.index', compact('subcategories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.subcategory.create', compact('categories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:sub_categories,slug',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('subcategories', 'public');
        }

        SubCategory::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'image' => $imagePath,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('admin.subcategory.index')->with('success', 'Sub Category created successfully!');
    }
    public function edit($id)
{
    $subcategory = SubCategory::findOrFail($id);
    $categories = Category::all(); // so you can change category in edit form
    return view('admin.subcategory.edit', compact('subcategory', 'categories'));
}

public function update(Request $request, $id)
{
    $subcategory = SubCategory::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'slug' => 'required|string|unique:sub_categories,slug,' . $id,

        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $subcategory->name = $request->name;
    $subcategory->description = $request->description;
    $subcategory->slug = $request->slug;
    $subcategory->category_id = $request->category_id;

    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('subcategory_images', 'public');
        $subcategory->image = $path;
    }

    $subcategory->save();

    return redirect()->route('admin.subcategory.index')->with('success', 'SubCategory updated successfully!');
}
public function destroy($id)
{
    $subcategory = SubCategory::findOrFail($id);

    // Delete image if exists
    if ($subcategory->image) {
        \Storage::disk('public')->delete($subcategory->image);
    }

    // Delete subcategory
    $subcategory->delete();

    return redirect()->route('admin.subcategory.index')->with('success', 'Subcategory deleted successfully!');
}
  public function checkSlug(Request $request)
{

    // Step 1: Convert name into slug
    $slug = Str::slug($request->slug);
$originalSlug = $slug;

if (SubCategory::where('slug', $slug)->exists()) {
    $slug = $originalSlug . '-' . time(); // adds current time
}

return response()->json(['slug' => $slug]);

    // Step 3: Return final unique slug in JSON
}
}
