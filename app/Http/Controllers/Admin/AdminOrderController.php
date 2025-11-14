<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'products'])->get();
        return view('admin.order.index', compact('orders'));
    }

    public function userDetails($userId)
    {
        $orders = Order::with('products', 'user')->where('user_id', $userId)->get();
        return view('admin.order.details', compact('orders'));
    }


   public function updateStatus(Request $request, $id)
{
    try {
    $order = Order::findOrFail($id);
    $newStatus = $request->status;

    // Rule: cannot ship unless confirmed
    if ($newStatus === 'shipped' && $order->status !== 'confirmed') {
        return response()->json(['error' => 'Order must be confirmed before shipping.']);
    }

    $order->status = $newStatus;
    $order->save();

    return response()->json(['success' => 'Order status updated successfully!']);
     } 
     catch (\Exception $e) {
        // Return JSON error instead of HTML
        return response()->json([
            'error' => 'Something went wrong.',
            'message' => $e->getMessage()
        ], 500);
    }
}

}
