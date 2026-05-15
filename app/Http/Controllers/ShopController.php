<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class ShopController extends Controller
{
    //
        public function index()
    {
        $products = Product::with('category')
            ->where('is_active', true)
            ->paginate(12);
        
        $categories = \App\Models\Category::withCount(['products' => function($q) {
        $q->where('is_active', true);
         }])->get();

        return view('pages.shop', compact('products', 'categories'));
    }
}
