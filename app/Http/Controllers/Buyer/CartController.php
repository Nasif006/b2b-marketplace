<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // -----------------------------
    // VIEW CART
    // -----------------------------
    public function index()
    {
        $cart = session()->get('cart', []);

        return view('buyer.cart.index', compact('cart'));
    }

    // -----------------------------
    // ADD TO CART
    // -----------------------------
    public function add($id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        // enforce MOQ rule
        $qty = $product->moq;

        if (isset($cart[$id])) {
            $cart[$id]['qty'] += $qty;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "price" => $product->price,
                "qty" => $qty,
                "moq" => $product->moq
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back();
    }

    // -----------------------------
    // REMOVE ITEM
    // -----------------------------
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back();
    }

    public function decrease($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {

            $cart[$id]['qty'] -= $cart[$id]['moq'];

            if ($cart[$id]['qty'] <= 0) {
                unset($cart[$id]);
            }

            session()->put('cart', $cart);
        }

        return redirect()->back();
    }
}
