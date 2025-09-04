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
    $products = Product::with(['category', 'subcategory'])->get();
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
        'category_id' => 'required|exists:categories,id',
       'subcategory_id' => 'required|exists:sub_categories,id',
        'price' => 'required|numeric',
        'discount' => 'nullable|numeric',
        'quantity' => 'required|integer',
        'description' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $product = new Product();
    $product->name = $request->name;
    $product->slug = $request->slug;
    $product->category_id = $request->category_id;
    $product->subcategory_id = $request->subcategory_id;
    $product->price = $request->price;
    $product->discount = $request->discount;
    $product->quantity = $request->quantity;
    $product->size = $request->has('size') ? json_encode($request->size) : null;
    $product->color = $request->has('color') ? json_encode($request->color) : null;
    $product->description = $request->description;
    $product->status = $request->has('status') ? 1 : 0;

    // Upload image if exists
    if ($request->hasFile('image')) {
        $filename = time() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads/products'), $filename);
        $product->image = $filename;
    }

    $product->save();

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
    $product = Product::findOrFail($id);

    $product->update([
        'name'          => $request->name,
        'slug'          => $request->slug,
        'category_id'   => $request->category_id,
        'subcategory_id'=> $request->subcategory_id,
        'price'         => $request->price,
        'discount'      => $request->discount,
        'quantity'      => $request->quantity,
        'size'          => json_encode($request->size),
        'color'         => json_encode($request->color),
        'description'   => $request->description,
        'image' => $request->file('image')
    ? $request->file('image')->store('products', 'public')
    : $product->image,
    ]);

    return redirect()->route('admin.product.index')->with('success', 'Product updated successfully!');
}

}
