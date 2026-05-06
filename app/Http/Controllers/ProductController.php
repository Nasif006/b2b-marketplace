<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function index()
    {
        $products = auth()->user()->products;
        return view('supplier.products.index', compact('products'));
    }

    public function create()
    {
        return view('supplier.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer|min:0',
            'moq' => 'required|integer',
        ]);

        auth()->user()->products()->create(
            $request->only(['name', 'price', 'stock', 'moq'])
        );

        return redirect('/supplier/products');
    }

    public function edit($id)
    {
        $product = auth()->user()->products()->findOrFail($id);

        return view('supplier.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = auth()->user()->products()->findOrFail($id);

        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'moq' => 'required|integer',
        ]);

        $product->update(
            $request->only(['name', 'price', 'stock', 'moq'])
        );

        return redirect('/supplier/products');
    }

    public function destroy($id)
    {
        $product = auth()->user()->products()->findOrFail($id);

        $product->delete();

        return redirect('/supplier/products');
    }
}
