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
            'name'  => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer|min:0',
            'moq'   => 'required|integer',
            'image' => 'nullable|url',
        ]);

        auth()->user()->products()->create(
            $request->only(['name', 'description', 'price', 'stock', 'moq', 'image'])
        );

        return redirect('/supplier/products')->with('success', 'Product added.');
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
            'name'  => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'moq'   => 'required|integer',
            'image' => 'nullable|url',
        ]);

        $product->update(
            $request->only(['name', 'description', 'price', 'stock', 'moq', 'image'])
        );

        return redirect('/supplier/products')->with('success', 'Product updated.');
    }

    public function destroy($id)
    {
        auth()->user()->products()->findOrFail($id)->delete();
        return redirect('/supplier/products')->with('success', 'Product deleted.');
    }
}
