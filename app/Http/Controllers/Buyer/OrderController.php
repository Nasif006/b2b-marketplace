<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function invoice($id)
    {
        $order = Order::with('items.product')->findOrFail($id);

        // security: user can only see own order
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        return view('buyer.orders.invoice', compact('order'));
    }

    public function index()
    {
        $orders = Order::with('items.product')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('buyer.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('items.product')
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        return view('buyer.orders.show', compact('order'));
    }
}
