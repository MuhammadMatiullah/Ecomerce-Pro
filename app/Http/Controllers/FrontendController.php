<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Cart;

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
    $cartItems = Cart::with('product')
        ->where('user_id', auth()->id())
        ->get();

    // Subtotal = sum of all (price * quantity)
    $subtotal = $cartItems->sum(function ($item) {
        return $item->product->price * $item->quantity;
    });

    // Example: flat shipping cost (you can make this dynamic too)
    $shipping = 3.00;

    // Total = subtotal + shipping
    $total = $subtotal + $shipping;

    return view('user.checkout.chectout', compact('cartItems', 'subtotal', 'shipping', 'total'));
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
