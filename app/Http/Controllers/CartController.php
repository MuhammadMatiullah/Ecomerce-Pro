<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CartController extends Controller
{
    // Show cart
    public function index()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        return view('user.cart.index', compact('cartItems'));
    }

    // Add to cart
    public function store($productId)
    {
        
        $cartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            Cart::create([
                'uuid'       => Str::uuid(),   // 👈 generate a UUID
                'user_id'    => Auth::id(),
                'product_id' => $productId,
                'quantity'   => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    // Remove from cart
    public function destroy($id)
    {
        $cartItem = Cart::findOrFail($id);
        $cartItem->delete();

        return response()->json(['success' => true]);
    }
    // Update quantity
    public function update(Request $request, $id)
    {
        $cartItem = Cart::where('user_id', Auth::id())->findOrFail($id);

        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return response()->json(['success' => true]);
    }
    public function proceedToCheckout(Request $request)
{
    $user = Auth::user();

    if (!$user) {
        return redirect()->route('login')->with('error', 'Please login first.');
    }

    if ($request->has('cart_items')) {
        foreach ($request->cart_items as $item) {
            if (isset($item['id']) && isset($item['quantity'])) {
                Cart::where('id', $item['id'])
                    ->where('user_id', $user->id)
                    ->update([
                        'quantity' => $item['quantity'],
                    ]);
            }
        }
    }

    // ✅ Redirect to checkout page after syncing
    return redirect()->route('checkout')->with('success', 'Cart updated! Proceed to checkout.');
}

}
