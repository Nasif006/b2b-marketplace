<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductBrowseController extends Controller
{

    public function index()
    {
        $products = Product::with('supplier')
            ->latest()
            ->paginate(12);

        return view('buyer.products.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::with('supplier')->findOrFail($id);

        return view('buyer.products.show', compact('product'));
    }
}
