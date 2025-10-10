<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\Order;

class OrderController extends Controller
{
   public function store(Request $request)
{
    $user = Auth::user();

    // If user is not logged in
    if (!$user) {
        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login to place an order.'
            ], 401);
        }

        return redirect()->route('login')->with('error', 'Please login to place an order.');
    }

    // Validate request
    try {
        $request->validate([
            'products' => 'nullable|array',
            'payment_method' => 'required|string',
            'subtotal' => 'required|numeric',
            'shipping' => 'required|numeric',
            'total' => 'required|numeric',
            'agree' => 'nullable|accepted',
        ], [
            'agree.accepted' => 'You must agree to the Terms & Conditions before placing your order.',
        ]);
    } catch (ValidationException $e) {
        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors(),
            ], 422);
        }

        return redirect()->back()->withErrors($e->errors())->withInput();
    }

    // ✅ Create order
    $order = $user->orders()->create([
        'payment_method' => $request->payment_method,
        'comment' => $request->comment,
        'subtotal' => $request->subtotal,
        'shipping' => $request->shipping,
        'total' => $request->total,
        'status' => 'pending',
    ]);

    // ✅ Attach multiple products (if any)
    if ($request->has('products') && is_array($request->products)) {
        foreach ($request->products as $product) {
            $order->products()->attach($product['id'], [
                'quantity' => $product['quantity'] ?? 1,
                'price'    => $product['price'] ?? 0,
                'user_id'  => $user->id, // 👈 Add this line
            ]);
        }
    }

    // ✅ Clear cart after order placement
    session()->forget('cart');

    // ✅ Response
    if ($request->ajax()) {
        return response()->json([
            'success' => true,
            'message' => 'Order placed successfully!',
            'order_id' => $order->id,
        ]);
    }

    return redirect()->route('checkout');
}

}
