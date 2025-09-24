<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;   
use App\Models\Slider; 
use App\Models\Category;
use App\Models\SubCategory;

class FrontendController extends Controller
{
    public function index()
    {
        // ✅ Get latest products (8 newest items)
        $products = Product::latest()->take(6)->get();

        // ✅ Get sliders from database
    $sliders = Slider::where('status', 1)->latest()->get();

        // ✅ Get categories with subcategories
        $categories = Category::with('subcategories')->get();

        // Pass data to frontend view
        return view('user.index', compact('products', 'sliders', 'categories'));
    }

    public function wishlist()
    {
        return view('user.wishlist');
    }

    public function checkout()
    {
        return view('user.checkout.chectout');
    }
    public function productDetails($slug)
{
    $product = \App\Models\Product::with(['categories', 'subcategories'])
        ->where('slug', $slug)
        ->firstOrFail();

    return view('user.product.show', compact('product'));
}
public function categoryShow($id)
{
    $category = Category::with('subcategories', 'products')->findOrFail($id);

    return view('user.category', compact('category'));
}

public function subcategoryShow($id)
{
    $subcategory = SubCategory::with('products')->findOrFail($id);

    return view('user.subcategory', compact('subcategory'));
}
}
