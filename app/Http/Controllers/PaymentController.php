<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Product;
use App\Models\Cart;

class PaymentController extends Controller
{
    // ✅ Show payment form
    public function index()
{
    $user = auth()->user();

    if (!$user) {
        return redirect()->route('login')->with('error', 'Please login to continue.');
    }

    $cartItems = \App\Models\Cart::where('user_id', $user->id)->get();

    if ($cartItems->isEmpty()) {
        return redirect()->route('frontend.index')->with('error', 'Your cart is empty.');
    }

    // ✅ Calculate subtotal securely
    $subtotal = 0;
    foreach ($cartItems as $item) {
        $product = \App\Models\Product::find($item->product_id);
        if ($product) {
            $subtotal += $product->price * ($item->quantity ?? 1);
        }
    }

    $shipping = 3; // example flat rate
    $total = $subtotal + $shipping;

    // ✅ Pass total to Blade view
    return view('user.payment.index', compact('total'));
}

    // ✅ Process Stripe payment and create order
    public function process(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'card_holder' => 'required|string',
            'stripeToken' => 'required|string',
        ]);

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to continue.');
        }

        // 🧩 Step 1: Get cart items
        $cartItems = Cart::where('user_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Your cart is empty.');
        }

        // 🧮 Step 2: Calculate subtotal securely (ignore user-sent prices)
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $product = Product::find($item->product_id);
            if ($product) {
                $subtotal += $product->price * ($item->quantity ?? 1);
            }
        }

        $shipping = 3; // flat shipping rate example
        $total = $subtotal + $shipping;

        // 💳 Step 3: Stripe charge
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $charge = \Stripe\Charge::create([
                'amount' => $total * 100, // Stripe expects cents
                'currency' => 'usd',
                'description' => 'Order Payment by ' . $user->name,
                'source' => $request->stripeToken,
            ]);
            // dd($charge);
            $status = $charge->status;
            dd($status);
            
            // 🧾 Step 4: Create order
            $order = $user->orders()->create([
                'payment_method' => 'stripe',
                'payment_status' => 'paid',
                'transaction_id' => $charge->id,
                'subtotal' => $subtotal,
                'shipping' => $shipping,
                'total' => $total,
                'status' => 'processing',
            ]);

            // 📦 Step 5: Attach ordered products
            foreach ($cartItems as $item) {
                $product = Product::find($item->product_id);
                if ($product) {
                    $order->products()->attach($product->id, [
                        'quantity' => $item->quantity ?? 1,
                        'price' => $product->price,
                        'user_id' => $user->id,
                    ]);
                }
            }

            // 🧹 Step 6: Clear the cart
            Cart::where('user_id', $user->id)->delete();

            // ✅ Step 7: Success response
            return redirect()->route('frontend.index')->with('success', 'Payment successful! Order placed.');

        } catch (\Exception $e) {
            // ❌ Handle Stripe or DB errors
            return back()->with('error', $e->getMessage());
        }
    }
}
