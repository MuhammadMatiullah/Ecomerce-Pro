<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class PaymentController extends Controller
{
    // Show payment page (user selects online payment)
    public function showPaymentPage()
    {
        return view('user.payment.index');
    }

    // Simulate payment processing
    public function processPayment(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'card_number' => 'required|min:16|max:16',
            'card_holder' => 'required|string',
            'expiry' => 'required',
            'cvv' => 'required|min:3|max:4',
        ]);

        // ✅ Simulate payment success (no real gateway)
        $paymentSuccess = true; // you can randomize if you want

        if (!$paymentSuccess) {
            return back()->with('error', 'Payment failed, please try again.');
        }

        // ✅ Create order after successful payment
        $order = Order::create([
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'payment_method' => 'online',
            'payment_status' => 'paid',
        ]);

        // ✅ Clear cart, session, etc.
        \App\Models\Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('frontend.index')->with('success', 'Payment successful! Order placed.');
    }
}
