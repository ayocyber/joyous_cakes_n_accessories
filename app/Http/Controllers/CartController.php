<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //
      public function index(Request $request)
    {
        $recommendations = Product::with('categories')
            ->where('is_active', true)
            ->inRandomOrder()
            ->limit(4)
            ->get();

        $currency = $request->get('currency', 'LRD');

        $rates = [
            'LRD' => 1,
            'USD' => 0.0055,
            'NGN' => 7.46,
        ];

        return view('pages.cart', compact('recommendations', 'rates', 'currency'));
    }
}
