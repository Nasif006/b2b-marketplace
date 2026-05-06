<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class SupplierOrderController extends Controller
{

    public function index()
    {
        $supplierId = auth()->id();

        $orders = Order::whereHas('items.product', function ($q) use ($supplierId) {
            $q->where('user_id', $supplierId);
        })
        ->with(['items.product'])
        ->latest()
        ->get();

        return view('supplier.orders.index', compact('orders'));
    }

    public function accept($id)
    {
        $order = Order::with('items.product')->findOrFail($id);

        // prevent double deduction
        if ($order->status !== 'pending') {
            return back()->with('error', 'Order already processed');
        }

        foreach ($order->items as $item) {

            $product = $item->product;

            // safety check
            if ($product->stock < $item->qty) {
                return back()->with('error', 'Not enough stock for ' . $product->name);
            }

            // reduce stock
            $product->stock -= $item->qty;
            $product->save();
        }

        $order->status = 'accepted';
        $order->save();

        return back()->with('success', 'Order accepted & stock updated');
    }

    public function reject($id)
    {
        $order = Order::findOrFail($id);

        if ($order->status !== 'pending') {
            return back();
        }

        $order->status = 'rejected';
        $order->save();

        return back()->with('success', 'Order rejected');
    }
}
