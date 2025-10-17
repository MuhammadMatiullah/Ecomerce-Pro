<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\Order;
use App\Models\Product;
use App\Models\Cart;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();

        // 🧱 Step 1: Ensure user is logged in
        if (!$user) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please login to place an order.'
                ], 401);
            }

            return redirect()->route('login')->with('error', 'Please login to place an order.');
        }

        // 🧱 Step 2: Validation (same as yours — unchanged)
        try {
            $request->validate([
                'products' => 'nullable|array',
                'payment_method' => 'required|string',
                'agree' => 'nullable|accepted',
            ], [
                'agree.accepted' => 'You must agree to the Terms & Conditions before placing your order.',
                'payment_method.required' => 'Please select a payment method before placing your order.',
            ]);
        } catch (ValidationException $e) {
            // ✅ Instead of dd(), return a friendly message or redirect back
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'errors' => $e->errors(),
                ], 422);
            }

            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        }

        // 🧩 Step 3: Update latest quantities from checkout form
        if ($request->has('cart_items')) {
            foreach ($request->cart_items as $item) {
                $cart = Cart::where('id', $item['id'])
                    ->where('user_id', $user->id)
                    ->first();

                if ($cart) {
                    $cart->update(['quantity' => $item['quantity']]);
                }
            }
        }

        // 🧮 Step 4: Securely calculate subtotal (ignore user-sent prices)
        $cartItems = Cart::where('user_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Your cart is empty. Cannot place an order.'
            ], 400);
        }

        $subtotal = 0;
        foreach ($cartItems as $item) {
            $product = Product::find($item->product_id);
            if (!$product) continue;
            $subtotal += $product->price * ($item->quantity ?? 1);
        }

        // 💸 Step 5: Calculate shipping and total
        $shipping = 3; // flat rate example
        $total = $subtotal + $shipping;

        // 🧾 Step 6: Create order
        $order = $user->orders()->create([
            'payment_method' => $request->payment_method,
            'comment' => $request->comment ?? null,
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'total' => $total,
            'status' => 'pending',
        ]);

        // 📦 Step 7: Attach products to order (real DB prices only)
        foreach ($cartItems as $item) {
            $realProduct = Product::find($item->product_id);

            if ($realProduct) {
                $order->products()->attach($realProduct->id, [
                    'quantity' => $item->quantity ?? 1,
                    'price' => $realProduct->price,
                    'user_id' => $user->id,
                ]);
            }
        }

        // 🧹 Step 8: Clear user's cart
        Cart::where('user_id', $user->id)->delete();

        // ✅ Step 9: Final Response
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Order placed successfully!',
                'order_id' => $order->id,
                'total' => $total,
            ]);
        }

        return redirect()->route('frontend.index')->with('success', 'Order placed successfully!');
    }
}
