<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Services\AutomationEngine;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect('/products');
        }

        return view('buyer.checkout.index', compact('cart'));
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect('/products');
        }

        // GROUP ITEMS BY SUPPLIER
        $grouped = [];

        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);
            $supplierId = $product->user_id;
            $grouped[$supplierId][] = [
                'product' => $product,
                'qty'     => $item['qty']
            ];
        }

        // CREATE ONE ORDER PER SUPPLIER
        foreach ($grouped as $supplierId => $items) {

            $total = 0;
            foreach ($items as $entry) {
                $total += $entry['product']->price * $entry['qty'];
            }

            $order = Order::create([
                'user_id'        => auth()->id(),
                'total'          => $total,
                'status'         => 'pending',
                'payment_method' => $request->payment_method,
                'payment_status' => $request->payment_method === 'cod' ? 'pending' : 'paid',
                'transaction_id' => $request->payment_method === 'fake'
                    ? 'TXN-' . strtoupper(uniqid())
                    : null,
            ]);

            foreach ($items as $entry) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $entry['product']->id,
                    'qty'        => $entry['qty'],
                    'price'      => $entry['product']->price,
                ]);
            }

            // FIRE AUTOMATION: order_placed
            AutomationEngine::fire('order_placed', $order, [
                'email'       => auth()->user()->email,
                'user_id'     => auth()->id(),
                'supplier_id' => $supplierId,
            ]);
        }

        session()->forget('cart');

        return redirect('/orders')->with('success', 'Order placed successfully.');
    }
}
