<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //
      public function index()
    {
        $recommendations = Product::with('category')
            ->where('is_active', true)
            ->inRandomOrder()
            ->limit(4)
            ->get();

        return view('pages.cart', compact('recommendations'));
    }
}
