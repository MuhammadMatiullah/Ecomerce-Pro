<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // Show all products
 public function index()
{
    $products = Product::with(['categories', 'subcategories'])
        ->latest()   // orders by created_at desc
        ->take(6)    // only latest 6
        ->get();

    return view('admin.product.index', compact('products'));
}


     public function create()
{
    $categories = Category::all();
    return view('admin.product.create', compact('categories'));
}
public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:products,slug',
        'categories' => 'required|array',
        'categories.*' => 'exists:categories,id',
        'subcategories' => 'required|array',
        'subcategories.*' => 'exists:sub_categories,id',
        'price' => 'required|numeric|min:1', // ✅ price must be > 0
        'discount' => 'nullable|numeric|min:0',
        'quantity' => 'required|integer',
        'description' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // ✅ Additional manual check for discount logic
    if ($request->discount && ($request->price - $request->discount) <= 0) {
        return back()
            ->withErrors(['discount' => 'Discount cannot make the final price zero or negative.'])
            ->withInput();
    }

    $product = new Product();
    $product->name = $request->name;
    $product->slug = $request->slug;
    $product->price = $request->price;
    $product->discount = $request->discount;
    $product->quantity = $request->quantity;
    $product->size = $request->has('size') ? json_encode($request->size) : null;
    $product->color = $request->has('color') ? json_encode($request->color) : null;
    $product->description = $request->description;
    $product->status = $request->has('status') ? 1 : 0;

    if ($request->hasFile('image')) {
        $filename = time() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads/products'), $filename);
        $product->image = $filename;
    }

    $product->save();

    $product->categories()->attach($request->categories);
    $product->subcategories()->attach($request->subcategories);

    return redirect()->route('admin.product.index')->with('success', 'Product added successfully!');
}



 public function checkSlug(Request $request)
{

    $slug = Str::slug($request->slug ?? $request->name ?? '');
    $originalSlug = $slug;

    $count = Product::where('slug', $slug)->count();
    if ($count > 0) {
        $slug = $originalSlug . '-' . time();
    }

    return response()->json(['slug' => $slug]);
}






public function getSubcategories($category_id)
{
    $subcategories = Subcategory::where('category_id', $category_id)->get();
    return response()->json($subcategories);
}

public function edit($id)
{
    $product = Product::findOrFail($id);
    $categories = Category::all();
    $subcategories = Subcategory::all();

    return view('admin.product.edit', compact('product', 'categories', 'subcategories'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:products,slug,' . $id,
        'categories' => 'required|array',
        'categories.*' => 'exists:categories,id',
        'subcategories' => 'required|array',
        'subcategories.*' => 'exists:sub_categories,id',
        'price' => 'required|numeric|min:1', // ✅ price must be > 0
        'discount' => 'nullable|numeric|min:0',
        'quantity' => 'required|integer',
        'description' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // ✅ Discount validation check
    if ($request->discount && ($request->price - $request->discount) <= 0) {
        return back()
            ->withErrors(['discount' => 'Discount cannot make the final price zero or negative.'])
            ->withInput();
    }

    $product = Product::findOrFail($id);
    $product->name = $request->name;
    $product->slug = $request->slug;
    $product->price = $request->price;
    $product->discount = $request->discount;
    $product->quantity = $request->quantity;
    $product->size = $request->has('size') ? json_encode($request->size) : null;
    $product->color = $request->has('color') ? json_encode($request->color) : null;
    $product->description = $request->description;
    $product->status = $request->has('status') ? 1 : 0;

    if ($request->hasFile('image')) {
        $filename = time() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads/products'), $filename);
        $product->image = $filename;
    }

    $product->save();

    $product->categories()->sync($request->categories);
    $product->subcategories()->sync($request->subcategories);

    return redirect()->route('admin.product.index')->with('success', 'Product updated successfully!');
}



public function destroy($id)
{
    $product = Product::findOrFail($id);

    // ✅ clean pivot relations
    $product->categories()->detach();
    $product->subcategories()->detach();

    $product->delete();

    return redirect()->back()->with('success', 'Product deleted successfully!');
}
public function show($slug)
{
    $product = Product::where('slug', $slug)->firstOrFail();
    return view('user.product.show', compact('product'));
}


}
