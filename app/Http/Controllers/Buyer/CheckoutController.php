<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class CheckoutController extends Controller
{
    // -----------------------------
    // SHOW CHECKOUT PAGE
    // -----------------------------
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect('/products');
        }

        return view('buyer.checkout.index', compact('cart'));
    }

    // -----------------------------
    // PLACE ORDER (placeholder logic)
    // -----------------------------



    public function store(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect('/products');
        }

        // -----------------------------
        // GROUP ITEMS BY SUPPLIER
        // -----------------------------
        $grouped = [];

        foreach ($cart as $productId => $item) {

            $product = Product::find($productId);

            $supplierId = $product->user_id; // supplier

            $grouped[$supplierId][] = [
                'product' => $product,
                'qty' => $item['qty']
            ];
        }

        // -----------------------------
        // CREATE MULTIPLE ORDERS
        // -----------------------------
        foreach ($grouped as $supplierId => $items) {

            $total = 0;

            foreach ($items as $entry) {
                $total += $entry['product']->price * $entry['qty'];
            }

            $order = Order::create([
                'user_id' => auth()->id(),
                'total' => $total,
                'status' => 'pending',
                'payment_method' => $request->payment_method,
                'payment_status' => $request->payment_method === 'cod' ? 'pending' : 'paid',
                'transaction_id' => $request->payment_method === 'fake'
                    ? 'TXN-' . strtoupper(uniqid())
                    : null,
            ]);

            // -----------------------------
            // CREATE ORDER ITEMS
            // -----------------------------
            foreach ($items as $entry) {

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $entry['product']->id,
                    'qty' => $entry['qty'],
                    'price' => $entry['product']->price,
                ]);
            }
        }

        // -----------------------------
        // CLEAR CART
        // -----------------------------
        session()->forget('cart');

        return redirect('/products')->with('success', 'Orders placed successfully');
    }

    // public function store(Request $request)
    // {
    //     $cart = session()->get('cart', []);

    //     if (empty($cart)) {
    //         return redirect('/products');
    //     }

    //     // -----------------------------
    //     // CALCULATE TOTAL
    //     // -----------------------------
    //     $total = 0;

    //     foreach ($cart as $item) {
    //         $total += $item['price'] * $item['qty'];
    //     }

    //     // -----------------------------
    //     // CREATE ORDER
    //     // -----------------------------
    //     $paymentMethod = $request->input('payment_method', 'cod');

    //     $order = Order::create([
    //         'user_id' => auth()->id(),
    //         'total' => $total,
    //         'status' => 'pending',
    //         'payment_method' => $paymentMethod,
    //         'payment_status' => $paymentMethod === 'cod' ? 'pending' : 'paid',
    //         'transaction_id' => $paymentMethod === 'fake' ? 'TXN-' . strtoupper(uniqid()) : null,
    //     ]);

    //     // -----------------------------
    //     // CREATE ORDER ITEMS
    //     // -----------------------------
    //     foreach ($cart as $productId => $item) {

    //         OrderItem::create([
    //             'order_id' => $order->id,
    //             'product_id' => $productId,
    //             'qty' => $item['qty'],
    //             'price' => $item['price']
    //         ]);
    //     }

    //     // -----------------------------
    //     // CLEAR CART
    //     // -----------------------------
    //     session()->forget('cart');

    //     return redirect("/orders/{$order->id}/invoice");
    // }
}
