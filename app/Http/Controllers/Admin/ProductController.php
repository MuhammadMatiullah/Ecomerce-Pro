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
        $subcategories = Subcategory::all();

        return view('admin.product.create', compact('categories', 'subcategories'));
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

    return redirect()->back()->with('success', 'Product added successfully!');
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
