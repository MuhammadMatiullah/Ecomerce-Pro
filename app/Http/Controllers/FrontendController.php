<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;   
use App\Models\Slider; 

class FrontendController extends Controller
{
    public function index()
    {
        // ✅ Get latest products (8 newest items)
        $products = Product::latest()->take(8)->get();

        // ✅ Get sliders from database
        $sliders = Slider::latest()->get();


        // Pass products to frontend view
        return view('user.index', compact('products', 'sliders'));
    }

    public function wishlist()
    {
        return view('user.wishlist');
    }

    public function checkout()
    {
        return view('user.checkout.chectout');
    }
}
