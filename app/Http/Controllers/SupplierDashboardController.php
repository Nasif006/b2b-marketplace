<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SupplierDashboardController extends Controller
{

    public function index()
    {
        $user = auth()->user();

        $products = $user->products;

        $totalProducts = $products->count();

        $lowStockProducts = $products->where('stock', '<=', 50);

        return view('supplier.dashboard', compact(
            'totalProducts',
            'lowStockProducts',
            'products'
        ));
    }
}
