<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Product;
use App\Models\Cart;

class PaymentController extends Controller
{
    /**
     * ✅ Show payment form
     */
    public function index()
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to continue.');
        }

        $cartItems = Cart::where('user_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('frontend.index')->with('error', 'Your cart is empty.');
        }

        // Calculate subtotal
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $product = Product::find($item->product_id);
            if ($product) {
                $subtotal += $product->price * ($item->quantity ?? 1);
            }
        }

        $shipping = 3; // Flat rate example
        $total = $subtotal + $shipping;

        return view('user.payment.index', compact('total'));
    }

    /**
     * ✅ Process Stripe Payment
     */
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

        $cartItems = Cart::where('user_id', $user->id)->get();
        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Your cart is empty.');
        }

        // Calculate totals
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $product = Product::find($item->product_id);
            if ($product) {
                $subtotal += $product->price * ($item->quantity ?? 1);
            }
        }

        $shipping = 3;
        $total = $subtotal + $shipping;

        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $charge = \Stripe\Charge::create([
                'amount' => $total * 100, // convert to cents
                'currency' => 'usd',
                'description' => 'Order Payment by ' . $user->name,
                'source' => $request->stripeToken,
            ]);

            // dd($charge);
            $status = $charge->status;

            

          
            /**
             * ✅ Handle payment status
             */
            if ($status === 'succeeded') {
                // ✅ Payment successful — Create order
                $order = $user->orders()->create([
                    'payment_method' => 'stripe',
                    'payment_status' => 'paid',
                    'transaction_id' => $charge->id,
                    'subtotal' => $subtotal,
                    'shipping' => $shipping,
                    'total' => $total,
                    'status' => 'processing',
                ]);

                // Attach products to order
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

                // Clear user’s cart
                Cart::where('user_id', $user->id)->delete();

                return redirect()->route('frontend.index')->with('success', '✅ Payment successful! Your order has been placed.');

            } elseif ($status === 'processing' || $status === 'requires_action' || $status === 'requires_source_action') {
                // ⏳ Payment pending
                return redirect()->route('payment.pending')->with('info', '⏳ Your payment is pending and awaiting confirmation.');

            } else {
                // ❌ Payment declined or failed
                return redirect()->route('payment.failed')->with('error', '❌ Your payment was declined. Please try again.');
            }
        } 
        catch (\Stripe\Exception\CardException $e) {
            // dd($e);
            // ❌ Specific card decline
            return redirect()->route('payment.failed')->with('error', 'Card declined: ' . $e->getError()->message);

        } 
    }
}
