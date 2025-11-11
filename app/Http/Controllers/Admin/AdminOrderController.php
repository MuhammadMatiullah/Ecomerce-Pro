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

}
